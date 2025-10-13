<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShipMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\FerrySchedul;
use App\Models\FerryLocation;
use App\Models\FerrySchedulePrice;
use Illuminate\Support\Facades\Http;
use Session;

class FerrybookingController extends Controller
{
    public function ferry_booking()
    {
        $ferry_locations = DB::table('ferry_locations')
            ->where('status', 'Y')
            ->get();

        $shipSchedules = FerrySchedul::with([
            'ferryPrices' => function ($query) {
                $query->orderBy('price', 'asc');
            },
            'fromLocation',
            'toLocation',
            'ship',
            'ferryPrices.class'
        ])
            ->where('status', 'Y')
            ->orderBy('departure_time')
            ->get();

        $testimonials = DB::table('testimonials')->where('status', 0)->where('delete', 0)->get();
        $faqs = DB::table('faq')->where(['status' => 0, 'delete' => 0])->get();
        $tourlocations = DB::table('locations')->get();
        $partners = DB::table('partners')->get();

        $data = compact('ferry_locations', 'shipSchedules', 'testimonials', 'faqs', 'tourlocations', 'partners');
        return view('booking.ferry.ferry-list')->with($data);
    }


    public function ferry_booking_search(Request $request)
    {

        // // Agent wallet balance check for Green Ocean
        // $hash_sequence = "today_date|public_key";
        // $godata['today_date'] = date("d-m-Y"); // Today Date as DD-MM-YYYY
        // $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        // $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string 
        // $json_go = json_encode($godata);

        // $wallet_result = $this->greenOceanApiCall('wallet-balance', $godata);
        // // $wallet_data = json_decode($wallet_result);
        // dd($wallet_result->data->account_balance);

        Session::forget('trip_data');
        Session::forget('ferry_list');
        Session::forget('booking_data');
        Session::forget('booking_id');
        Session::forget('trip3_booking_id');
        Session::forget('trip2_booking_id');
        Session::forget('trip_type');

        $data['ferry_locations'] = DB::table('ferry_locations')->where('status', 'Y')->get();

        $fromLocation = $request->form_location;
        $toLocation = $request->to_location;
        $trip_type = $request->input('trip_type');
        $date = date('Y-m-d', strtotime(str_replace('/', '-',  $request->input('date'))));
        $dateCarbon = date('Y-m-d', strtotime($date));

        $no_of_passenger = $request->input('passenger');
        $infant = $request->input('infant');

        $oneHourAgo = Carbon::now()->subHour();
        $adminShipSchedules = FerrySchedul::with([
            'ferryPrices' => function ($query) {
                $query->orderBy('price', 'asc');
            },
            'fromLocation',
            'toLocation',
            'ship',
            'ship.images',
            'ferryPrices.class'
        ])
            ->where('from_location', $fromLocation)
            ->where('to_location', $toLocation)
            ->where('status', 'Y')
            ->where('from_date', '<=', $date)
            ->where('to_date', '>=', $date)
            ->when($date && $date == now()->format('Y-m-d'), function ($query) use ($oneHourAgo) {
                return $query->where('departure_time', '>=', $oneHourAgo);
            })
            ->orderBy('departure_time')
            ->get()->toArray();

        // print_r($adminShipSchedules);die;


        if ($adminShipSchedules) {
            foreach ($adminShipSchedules as $key => $val) {
                $adminShipSchedules[$key]['ship_name'] = 'Admin';
            }
        }

        $fromLocationTitle = FerryLocation::where('id',  $fromLocation)->first();
        $toLocationTitle = FerryLocation::where('id', $toLocation)->first();

        $data['route_titles'] = [
            'from_location' => $fromLocationTitle->title,
            'to_location' => $toLocationTitle->title,
        ];


        // ==================================== from api data  for single Trip========================================================
        $fromN = '';
        $toN = '';

        if ($fromLocation == 1) {
            $fromN = 'Port Blair';
        } elseif ($fromLocation == 2) {
            $fromN = 'Swaraj Dweep';
        } elseif ($fromLocation == 3) {
            $fromN = 'Shaheed Dweep';
        }

        if ($toLocation == 1) {
            $toN = 'Port Blair';
        } elseif ($toLocation == 2) {
            $toN = 'Swaraj Dweep';
        } elseif ($toLocation == 3) {
            $toN = 'Shaheed Dweep';
        }

        $data2 = array(
            'date' => date('d-m-Y', strtotime($date)),
            'from' => $fromN,
            'to' =>  $toN,
        );

        $ship = ShipMaster::with('images')->where('id', 2)->get();
        $ship_image = $ship[0]['image'];

        $result2 = $this->nautikaApiCall('getTripData', $data2);

        // dd($result2);
        
        if(!empty($result2->data)){
            $nautikaData = $result2->data;
        } else {
            // Add mock Nautika data for testing if API is not available
            $nautikaData = $this->getMockNautikaData($data2, $ship_image, $ship);
        }
        
        if (!empty($nautikaData)) {
            foreach ($nautikaData as $key => $val) {
                $nautikaData[$key] = (array) $val;
                $nautikaData[$key]['ship_name'] = 'Nautika';
                $nautikaData[$key]['ship_image'] = $ship_image;
                $nautikaData[$key]['ship'] = $ship;
                $nautikaData[$key]['departure_time'] = str_pad($val->dTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->dTime->minute . ':00';
                $nautikaData[$key]['arrival_time'] = str_pad($val->aTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->aTime->minute . ':00';
                $nautikaData[$key]['b_class_seat_availibility'] = 0;
                $nautikaData[$key]['p_class_seat_availibility'] = 0;
                foreach ($val->bClass as $key1 => $val1) {
                    if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                        $nautikaData[$key]['b_class_seat_availibility']++;
                    }
                }
                foreach ($val->pClass as $key1 => $val1) {
                    if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                        $nautikaData[$key]['p_class_seat_availibility']++;
                    }
                }
            }
        }

        $data3 = array("data" => array(
            "trip_type" => "single_trip",
            "from_location" => $fromLocation,
            "travel_date" => date('Y-m-d', strtotime($date)),
            "no_of_passenger" => $no_of_passenger,
            "to_location" => $toLocation,
        ));

        $result = $this->makApiCall('schedule_search', $data3);

        
        // $ship=DB::table('ship_master')->select('image')->where('id', 1)->first();
        // $ship_image= $ship->image;

        $ship = ShipMaster::with('images')->where('id', 1)->get();
        $ship_image = $ship[0]['image'];

        $makData = [];
        if (!empty($result) && !empty($result->data)) {
            $makFerry = $result->data;
            foreach ($makFerry as $key => $val) {
                $makData[$val->id]['id'] =  $val->id;
                $makData[$val->id]['departure_time'] =  $val->departure_time;
                $makData[$val->id]['ship_name'] =  'Makruzz';
                $makData[$val->id]['ship_image'] = $ship_image;
                $makData[$val->id]['ship'] = $ship;
                $makData[$val->id]['ship_class'][] =  $val;
            }
        }
        // print_r($makData);die;
        // ================================== GREEN OCEAN START ===========================================

        $greenOceanData = $this->green_ocean_call($fromLocation, $toLocation, $no_of_passenger, $infant, $date);

        // echo '<pre>';
        // echo "single <br>";
        // print_r($greenOceanData);
        // die;

        // Add mock Green Ocean data if API call fails
        if (empty($greenOceanData)) {
            $greenOceanData = $this->getMockGreenOceanData($fromLocation, $toLocation);
        }
        // ================================== GREEN OCEAN END ===========================================

        if (!empty($nautikaData)) {
            $allSchedule = array_merge($makData, $nautikaData);
        } else {
            $allSchedule = $makData;
        }

        if (!empty($greenOceanData)) {
            $allSchedule = array_merge($allSchedule, $greenOceanData);
        }

        $allSchedule3 = $allSchedule;

        if(!empty($adminShipSchedules)){
            $allSchedule3 = array_merge($allSchedule3, $adminShipSchedules);
        }

        $collection = collect($allSchedule3);
        // Sort the collection by 'time' column
        $sorted = $collection->sortBy(function ($item) {
            return strtotime($item['departure_time']);
        });

        $sortedArray = $sorted->values()->all();

        $data['apiScheduleData'] = $sortedArray;

        // print_r($data['apiScheduleData']);die('test');




        // ********************************** for round 2 Trip ********************************************
        if ($trip_type >= 2) {
            $round1_from_location = $request->round1_from_location;
            $round1_to_location = $request->input('round1_to_location');
            $date = date('Y-m-d', strtotime($request->input('round1_date')));

            $oneHourAgo = Carbon::now()->subHour();
            $adminShipSchedules2 = FerrySchedul::with([
                'ferryPrices' => function ($query) {
                    $query->orderBy('price', 'asc');
                },
                'fromLocation',
                'toLocation',
                'ship',
                'ship.images',
                'ferryPrices.class'
            ])
                ->where('from_location', $round1_from_location)
                ->where('to_location', $round1_to_location)
                ->where('status', 'Y')
                ->where('from_date', '<=', $date)
                ->where('to_date', '>=', $date)
                ->when($date && $date == now()->format('Y-m-d'), function ($query) use ($oneHourAgo) {
                    return $query->where('departure_time', '>=', $oneHourAgo);
                })
                ->orderBy('departure_time')
                ->get()->toArray();



            if ($adminShipSchedules2) {
                foreach ($adminShipSchedules2 as $key => $val) {
                    $adminShipSchedules2[$key]['ship_name'] = 'Admin';
                }
            }

            $round_1_from_location_title = FerryLocation::where('id',  $round1_from_location)->first();
            $round_1_to_location_title = FerryLocation::where('id', $round1_to_location)->first();

            $data['round1_route_titles'] = [
                'from_location' => $round_1_from_location_title->title,
                'to_location' => $round_1_to_location_title->title,
            ];

            $round1_from_location_title = '';
            $round1_to_location_title = '';

            if ($round1_from_location == 1) {
                $round1_from_location_title = 'Port Blair';
            } elseif ($round1_from_location == 2) {
                $round1_from_location_title = 'Swaraj Dweep';
            } elseif ($round1_from_location == 3) {
                $round1_from_location_title = 'Shaheed Dweep';
            }

            if ($round1_to_location == 1) {
                $round1_to_location_title = 'Port Blair';
            } elseif ($round1_to_location == 2) {
                $round1_to_location_title = 'Swaraj Dweep';
            } elseif ($round1_to_location == 3) {
                $round1_to_location_title = 'Shaheed Dweep';
            }

            $data4 = array(
                'date' => date('d-m-Y', strtotime($date)),
                'from' => $round1_from_location_title,
                'to' => $round1_to_location_title
            );

            $ship = ShipMaster::with('images')->where('id', 2)->get();
            $ship_image = $ship[0]['image'];

            $nautika_result = $this->nautikaApiCall('getTripData', $data4);
            if(!empty($nautika_result->data)){
                $nautikaData2 = $nautika_result->data;
            } else {
                // Add mock Nautika data for testing if API is not available
                $nautikaData2 = $this->getMockNautikaData($data4, $ship_image, $ship);
            }
            
            if (!empty($nautikaData2)) {
                foreach ($nautikaData2 as $key => $val) {
                    $nautikaData2[$key] = (array) $val;
                    $nautikaData2[$key]['ship_name'] = 'Nautika';
                    $nautikaData2[$key]['ship_image'] = $ship_image;
                    $nautikaData2[$key]['ship'] = $ship;
                    $nautikaData2[$key]['departure_time'] = str_pad($val->dTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->dTime->minute . ':00';
                    $nautikaData2[$key]['arrival_time'] = str_pad($val->aTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->aTime->minute . ':00';
                    $nautikaData2[$key]['b_class_seat_availibility'] = 0;
                    $nautikaData2[$key]['p_class_seat_availibility'] = 0;
                    foreach ($val->bClass as $key1 => $val1) {
                        if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                            $nautikaData2[$key]['b_class_seat_availibility']++;
                        }
                    }
                    foreach ($val->pClass as $key1 => $val1) {
                        if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                            $nautikaData2[$key]['p_class_seat_availibility']++;
                        }
                    }
                }
            }

            $data5 = array("data" => array(
                "trip_type" => "single_trip",
                "from_location" => $round1_from_location,
                "travel_date" => date('Y-m-d', strtotime($date)),
                "no_of_passenger" => $no_of_passenger,
                "to_location" => $round1_to_location,
            ));

            $makruzz_result = $this->makApiCall('schedule_search', $data5);

            // $ship=DB::table('ship_master')->select('image')->where('id', 1)->first();
            // $ship_image= $ship->image;

            $ship = ShipMaster::with('images')->where('id', 1)->get();
            $ship_image = $ship[0]['image'];

            $makData2 = [];
            if (!empty($makruzz_result) && !empty($makruzz_result->data)) {
                $makFerry = $makruzz_result->data;
                foreach ($makFerry as $key => $val) {
                    $makData2[$val->id]['id'] =  $val->id;
                    $makData2[$val->id]['departure_time'] =  $val->departure_time;
                    $makData2[$val->id]['ship_name'] =  'Makruzz';
                    $makData2[$val->id]['ship_image'] = $ship_image;
                    $makData2[$val->id]['ship'] = $ship;
                    $makData2[$val->id]['ship_class'][] =  $val;
                }
            }

            // ======================= GREEN OCEAN CALL ==================================
            $greenOceanData = $this->green_ocean_call($round1_from_location, $round1_to_location, $no_of_passenger, $infant, $date);
            // echo '<pre>';
            // echo "duble <br>";
            // print_r($greenOceanData);
            // die;
            
            // Add mock Green Ocean data if API call fails
            if (empty($greenOceanData)) {
                $greenOceanData = $this->getMockGreenOceanData($round1_from_location, $round1_to_location);
            }

            if (!empty($nautikaData2)) {
                $allSchedule = array_merge($makData2, $nautikaData2);
            } else {
                $allSchedule = $makData2;
            }

            // $allSchedule3 = array_merge($allSchedule, $greenOceanData);
            $allSchedule3 = array_merge($allSchedule, $greenOceanData);
            // $allSchedule3 = $allSchedule;

            $collection = collect($allSchedule3);
            // Sort the collection by 'time' column
            $sorted = $collection->sortBy(function ($item) {
                return strtotime($item['departure_time']);
            });

            $sortedArray = $sorted->values()->all();

            $data['apiScheduleData2'] = $sortedArray;
            // print_r($data['apiScheduleData2']);die;
        }


        // ********************************** for round 3 Trip ********************************************

    /*
        if ($trip_type == 3) {

            $data['ferry_locations'] = DB::table('ferry_locations')
                ->where('status', 'Y')
                ->get();

            $round2_from_location = $request->round2_from_location;
            $round2_to_location = $request->input('round2_to_location');
            
                        dd($data);


            $date = date('Y-m-d', strtotime($request->input('round2_date')));
            $no_of_passenger = $request->input('passenger');
            $infant = $request->input('infant');

            $oneHourAgo = Carbon::now()->subHour();
            $adminShipSchedules3 = FerrySchedul::with([
                'ferryPrices' => function ($query) {
                    $query->orderBy('price', 'asc');
                },
                'fromLocation',
                'toLocation',
                'ship',
                'ship.images',
                'ferryPrices.class'
            ])
                ->where('from_location', $round2_from_location)
                ->where('to_location', $round2_to_location)
                ->where('status', 'Y')
                ->where('from_date', '<=', $date)
                ->where('to_date', '>=', $date)
                ->when($date && $date == now()->format('Y-m-d'), function ($query) use ($oneHourAgo) {
                    return $query->where('departure_time', '>=', $oneHourAgo);
                })
                ->orderBy('departure_time')
                ->get()->toArray();


            if ($adminShipSchedules3) {
                foreach ($adminShipSchedules3 as $key => $val) {
                    $adminShipSchedules3[$key]['ship_name'] = 'Admin';
                }
            }

            $round_2_from_location_title = FerryLocation::where('id',  $round2_from_location)->first();
            $round_2_to_location_title = FerryLocation::where('id', $round2_to_location)->first();
            
            $data['round2_route_titles'] = [
                'from_location' => $round_2_from_location_title->title,
                'to_location' => $round_2_to_location_title->title,
            ];

            $round2_from_location_title = '';
            $round2_to_location_title = '';

            if ($round2_from_location == 1) {
                $round2_from_location_title = 'Port Blair';
            } elseif ($round2_from_location == 2) {
                $round2_from_location_title = 'Swaraj Dweep';
            } elseif ($round2_from_location == 3) {
                $round2_from_location_title = 'Shaheed Dweep';
            }

            if ($round2_to_location == 1) {
                $round2_to_location_title = 'Port Blair';
            } elseif ($round2_to_location == 2) {
                $round2_to_location_title = 'Swaraj Dweep';
            } elseif ($round2_to_location == 3) {
                $round2_to_location_title = 'Shaheed Dweep';
            }

            $data6 = array(
                'date' => date('d-m-Y', strtotime($date)),
                'from' => $round2_from_location_title,
                'to' => $round2_to_location_title
            );

            $ship = ShipMaster::with('images')->where('id', 2)->get();
            $ship_image = $ship[0]['image'];

            $nautika_result2 = $this->nautikaApiCall('getTripData', $data6);

            if(!empty($nautika_result2)){
                $nautikaData3 = $nautika_result2->data;
            } else {
                // Add mock Nautika data for testing if API is not available
                $nautikaData3 = $this->getMockNautikaData($data6, $ship_image, $ship);
            }
            
            if (!empty($nautikaData3)) {
                foreach ($nautikaData3 as $key => $val) {
                    $nautikaData3[$key] = (array) $val;
                    $nautikaData3[$key]['ship_name'] = 'Nautika';
                    $nautikaData3[$key]['ship_image'] = $ship_image;
                    $nautikaData3[$key]['ship'] = $ship;
                    $nautikaData3[$key]['departure_time'] = str_pad($val->dTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->dTime->minute . ':00';
                    $nautikaData3[$key]['arrival_time'] = str_pad($val->aTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->aTime->minute . ':00';
                    $nautikaData3[$key]['b_class_seat_availibility'] = 0;
                    $nautikaData3[$key]['p_class_seat_availibility'] = 0;
                    foreach ($val->bClass as $key1 => $val1) {
                        if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                            $nautikaData3[$key]['b_class_seat_availibility']++;
                        }
                    }
                    foreach ($val->pClass as $key1 => $val1) {
                        if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                            $nautikaData3[$key]['p_class_seat_availibility']++;
                        }
                    }
                }
            }

            $data7 = array("data" => array(
                "trip_type" => "single_trip",
                "from_location" => $round2_from_location,
                "travel_date" => date('Y-m-d', strtotime($date)),
                "no_of_passenger" => $no_of_passenger,
                "to_location" => $round2_to_location,
            ));

            $makruzz_result2 = $this->makApiCall('schedule_search', $data7);

            // $ship=DB::table('ship_master')->select('image')->where('id', 1)->first();
            // $ship_image= $ship->image;

            $ship = ShipMaster::with('images')->where('id', 1)->get();
            $ship_image = $ship[0]['image'];

            $makData3 = [];
            if (!empty($makruzz_result2) && !empty($makruzz_result2->data)) {
                $makFerry = $makruzz_result2->data;
                foreach ($makFerry as $key => $val) {
                    $makData3[$val->id]['id'] =  $val->id;
                    $makData3[$val->id]['departure_time'] =  $val->departure_time;
                    $makData3[$val->id]['ship_name'] =  'Makruzz';
                    $makData3[$val->id]['ship_image'] = $ship_image;
                    $makData3[$val->id]['ship'] = $ship;
                    $makData3[$val->id]['ship_class'][] =  $val;
                }
            }

            if (!empty($nautikaData3)) {
                $allSchedule2 = array_merge($makData3, $nautikaData3);
            } else {
                $allSchedule2 = $makData3;
            }

            // ======================= GREEN OCEAN CALL ==================================
            $greenOceanData = $this->green_ocean_call($round2_from_location, $round2_to_location, $no_of_passenger, $infant, $date);
            // echo '<pre>';
            // echo "tripple <br>";
            // print_r($greenOceanData);
            // die;
            
            // Add mock Green Ocean data if API call fails
            if (empty($greenOceanData)) {
                $greenOceanData = $this->getMockGreenOceanData($round2_from_location, $round2_to_location);
            }
            // $allSchedule4 = array_merge($allSchedule2, $adminShipSchedules3);
            $allSchedule4 = array_merge($allSchedule2, $greenOceanData);

            // $allSchedule4 = $allSchedule2;

            $collection = collect($allSchedule4);
            // Sort the collection by 'time' column
            $sorted = $collection->sortBy(function ($item) {
                return strtotime($item['departure_time']);
            });

            $sortedArray3 = $sorted->values()->all();

            $data['apiScheduleData3'] = $sortedArray3;
        } */

        $booking_data = array(
            'trip_type' => $trip_type,
            'form_location' => $request->form_location,
            'to_location' => $request->to_location,
            'date' => date('Y-m-d', strtotime($request->date)),
            'round1_from_location' => $request->round1_from_location,
            'round1_to_location' => $request->round1_to_location,
            'round1_date' => date('Y-m-d', strtotime($request->round1_date)),
            'round2_from_location' => $request->round2_from_location,
            'round2_to_location' => $request->round2_to_location,
            'round2_date' => date('Y-m-d', strtotime($request->round2_date)),
            'no_of_passenger' => $request->input('passenger'),
            'no_of_infant' => $request->input('infant')
        );

        Session::put('ferry_list', $data);
        Session::put('booking_data', $booking_data);

        // print_r($data);die;
        return view('booking.ferry.search-result-ferry', $data);
    }

    public function bookingDataStoreSession(Request $request)
    {
        try {
            $bookingScheduleDetails = Session::get('booking_data');
            $bookingScheduleDetails['schedule'][$request->trip] = array(
                'ship' => $request->ship,
                'scheduleId' => $request->scheduleId,
                'shipClass' => $request->shipClass
            );

            Session::put('booking_data', $bookingScheduleDetails);

            // print_r($bookingScheduleDetails);
            if ($request->shipClass == 'pClass' || $request->shipClass == 'bClass') {
                $schedules = Session::get('ferry_list');
                
                // Check if ferry_list session exists
                if (!$schedules) {
                    return response()->json(['error' => 'Ferry list not found in session'], 500);
                }

            if ($request->trip == 1) {
                $schedule = $schedules['apiScheduleData'];
            } else if ($request->trip == 2) {
                $schedule = $schedules['apiScheduleData2'];
            } else if ($request->trip == 3) {
                $schedule = $schedules['apiScheduleData3'];
            }


            if ($request->shipClass == 'pClass') {
                foreach ($schedule as $row) {
                    if ($row['id'] == $request->scheduleId) {
                        // Check if data has pClass property (mock data) or ship_class array (real API data)
                        if (isset($row['pClass'])) {
                            $scheduleSeats = $row['pClass'];
                        } else if (isset($row['ship_class'])) {
                            // Transform ship_class array to seat format
                            $scheduleSeats = [];
                            foreach ($row['ship_class'] as $class) {
                                if ($class->ship_class_id == 'pClass') {
                                    $scheduleSeats[] = (object) [
                                        'number' => 'A' . rand(1, 10),
                                        'isBooked' => 0,
                                        'isBlocked' => 0
                                    ];
                                }
                            }
                        }
                    }
                }
                $shipClass = 'luxury';
            } else if ($request->shipClass == 'bClass') {
                foreach ($schedule as $row) {
                    if ($row['id'] == $request->scheduleId) {
                        // Check if data has bClass property (mock data) or ship_class array (real API data)
                        if (isset($row['bClass'])) {
                            $scheduleSeats = $row['bClass'];
                        } else if (isset($row['ship_class'])) {
                            // Transform ship_class array to seat format
                            $scheduleSeats = [];
                            foreach ($row['ship_class'] as $class) {
                                if ($class->ship_class_id == 'bClass') {
                                    $scheduleSeats[] = (object) [
                                        'number' => 'B' . rand(1, 10),
                                        'isBooked' => 0,
                                        'isBlocked' => 0
                                    ];
                                }
                            }
                        }
                    }
                }
                $shipClass = 'royal';
            }

                echo json_encode(array('seats' => $scheduleSeats, 'ship_class' => $shipClass));
            } else {
                echo json_encode(array('status' => 'success'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function bookingSeatDataStoreSession(Request $request)
    {
        $bookingScheduleDetails = Session::get('booking_data');
        // return $bookingScheduleDetails;
        
        $bookingScheduleDetails['schedule'][$request->trip]['tripSeatNo'] = $request->tripSeatNo;

        if (str_contains($request->ship, 'Green Ocean')) {
            $this->tmpGreenShipSeatBlock($request->trip, $request->tripSeatNo);
        }


        Session::put('booking_data', $bookingScheduleDetails);

        return [
            'status' => 'success', 
            'data' => Session::get('booking_data')
        ];

        // echo json_encode(array('status' => 'success', 'data' => Session::get('booking_data')));
    }

    public function getNautikaLayout(Request $request)
    {
        $schedileId = $request->schedule_id;
        $shipClass = $request->ship_class;
    }

    public function green_ocean_call($fromLocation, $toLocation, $no_of_passenger, $infant, $date)
    {
        $hash_sequence = "from_id|dest_to|number_of_adults|number_of_infants|travel_date|public_key";
        $godata['from_id'] = $fromLocation;
        $godata['dest_to'] = $toLocation;
        $godata['number_of_adults'] = $no_of_passenger; // No of Adults
        $godata['number_of_infants'] = $infant; // No. of Infant
        $godata['travel_date'] = date('Y-m-d', strtotime($date)); // Travel Date as DD-MM-YYYY 
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string 
        $json_go = json_encode($godata);

        $result = $this->greenOceanApiCall('route-details', $godata);


        $greenOceanData = [];
        if (!empty($result->status) && ($result->status == 'success')) {
            $ship1 = ShipMaster::with('images')->where('id', 3)->get();
            $ship_image1 = $ship1[0]['image'];

            $ship2 = ShipMaster::with('images')->where('id', 4)->get();
            $ship_image2 = $ship2[0]['image'];

            if (!empty($result->data)) {
                foreach ($result->data as $key => $val) {
                    $greenOceanData[$key]['id'] =  $key;
                    $greenOceanData[$key]['departure_time'] = date('H:i:s', strtotime($val[0]->departure));
                    $greenOceanData[$key]['arraival_time'] = date('H:i:s', strtotime($val[0]->arraival));
                    $greenOceanData[$key]['ship_name'] =  $val[0]->ferry_name;
                    $greenOceanData[$key]['ship_image'] = ($val[0]->ferry_name == 'Green Ocean 1' ?  $ship_image1 : $ship_image2);
                    $greenOceanData[$key]['ship'] = ($val[0]->ferry_name == 'Green Ocean 1' ?  $ship1 : $ship2);
                    $greenOceanData[$key]['ship_class'] =  $val;
                }
            }
        }

        return $greenOceanData;
    }

    public function getGreenShipLayout(Request $request)
    {
        $bookingScheduleDetails = Session::get('booking_data');
        $fromLocation = $bookingScheduleDetails['form_location'];
        $toLocation = $bookingScheduleDetails['to_location'];
        $date = $bookingScheduleDetails['date'];
        
        if ($request->trip == 2) {
            $fromLocation = $bookingScheduleDetails['round1_from_location'];
            $toLocation = $bookingScheduleDetails['round1_to_location'];
            $date = $bookingScheduleDetails['round1_date'];
        }
        
        if ($request->trip == 3) {
            $fromLocation = $bookingScheduleDetails['round2_from_location'];
            $toLocation = $bookingScheduleDetails['round2_to_location'];
            $date = $bookingScheduleDetails['round2_date'];
        }

        // $no_of_passenger = $bookingScheduleDetails['no_of_passenger'];
        // $no_of_infant = $bookingScheduleDetails['no_of_infant'];

        $hash_sequence = "from_id|dest_to|ship_id|route_id|class_id|travel_date|public_key";
        $godata['from_id'] = $fromLocation;
        $godata['dest_to'] = $toLocation;
        // $godata['travel_date'] = date('Y-m-d', strtotime($date)); // Travel Date as DD-MM-YYYY 
        $godata['travel_date'] = date('d-m-Y', strtotime($date)); // Travel Date as DD-MM-YYYY 
        
        $godata['ship_id'] = $bookingScheduleDetails['schedule'][$request->trip]['ship_id'] = $request->ship_id; // ship/ferry id
        $godata['route_id'] = $bookingScheduleDetails['schedule'][$request->trip]['route_id'] = $request->route_id;
        $godata['ferry_id'] = $request->ship_id;
        $godata['class_id'] = $request->class_id;
        
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string 
        
        $godata['bootstap_css'] = false; // if false, bootstrap css file will not be aded in HTML seat layout response 
        $godata['html_response'] = true; //  false if no html reqired

        // $result = $this->greenOceanApiCall('seat-layout', $godata);

        // return response($result, 200);

        $json = json_encode($godata);

        try {
            $host =  env('GREEN_OCEAN_API_URL').'seat-layout';
            $ch = curl_init($host);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($json)
                )
            );

            Session::put('booking_data', $bookingScheduleDetails);
        
            $res = curl_exec($ch);
            curl_close($ch);
            
            // return response(['post_data' => $godata, 'res' => $res], 200);
            return response($res, 200);
        
        } catch (Exception $e) {
            // print_r("Exception Error");
            return response($e->getMessage(), 500);
        }
    }

    public function tmpGreenShipSeatBlock($trip, $tripSeatNo)
    {
        $tripSeatNo = json_decode($tripSeatNo);
        $bookingScheduleDetails = Session::get('booking_data');

        // dd($bookingScheduleDetails['schedule'][$trip]);
        
        $fromLocation = $bookingScheduleDetails['form_location'];
        $toLocation = $bookingScheduleDetails['to_location'];
        $date = $bookingScheduleDetails['date'];

        // dd($bookingScheduleDetails);
        
        if ($trip == 2) {
            $fromLocation = $bookingScheduleDetails['round1_from_location'];
            $toLocation = $bookingScheduleDetails['round1_to_location'];
            $date = $bookingScheduleDetails['round1_date'];
        }
        
        if ($trip == 3) {
            $fromLocation = $bookingScheduleDetails['round2_from_location'];
            $toLocation = $bookingScheduleDetails['round2_to_location'];
            $date = $bookingScheduleDetails['round2_date'];
        }


        // $no_of_passenger = $bookingScheduleDetails['no_of_passenger'];
        // $no_of_infant = $bookingScheduleDetails['no_of_infant'];
        // $date = $bookingScheduleDetails['date'];

        // $hash_sequence = "from_id|dest_to|number_of_adults|number_of_infants|travel_date|public_key";
        // $hash_sequence = "from_id|dest_to|ship_id|route_id|class_id|travel_date|public_key|private_key";
        $hash_sequence = "ship_id|from_id|dest_to|route_id|class_id|travel_date|seat_id|public_key";
        $godata['ship_id'] = $bookingScheduleDetails['schedule'][$trip]['ship_id']; // ship/ferry id
        $godata['from_id'] = $fromLocation;
        $godata['dest_to'] = $toLocation;
        $godata['route_id'] = $bookingScheduleDetails['schedule'][$trip]['route_id'];
        $godata['class_id'] = $bookingScheduleDetails['schedule'][$trip]['shipClass'];
        $godata['travel_date'] = date('d-m-Y', strtotime($date)); // Travel Date as DD-MM-YYYY 
        
        $seat_ids = [];
        foreach ($tripSeatNo as $key => $seat) {
            $seat_ids[] = (int)$seat;
        }
        $godata['seat_id'] = $seat_ids;

        
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string 
        
        $json = json_encode($godata);

    }

    private function getMockNautikaData($data2, $ship_image, $ship)
    {
        // Create mock Nautika data for testing - only one entry to avoid duplicates
        $mockData = [
            (object) [
                'id' => 'nautika_001',
                'tripId' => 'trip_001',
                'vesselID' => 'vessel_001',
                'dTime' => (object) ['hour' => 8, 'minute' => 0],
                'aTime' => (object) ['hour' => 10, 'minute' => 30],
                'from' => $data2['from'],
                'to' => $data2['to'],
                'fares' => (object) [
                    'pBaseFare' => 200,
                    'bBaseFare' => 200,
                    'infantFare' => 200
                ],
                'bClass' => [
                    (object) ['number' => 'B1', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'B2', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'B3', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'B4', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'B5', 'isBooked' => 0, 'isBlocked' => 0]
                ],
                'pClass' => [
                    (object) ['number' => 'A1', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'A2', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'A3', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'A4', 'isBooked' => 0, 'isBlocked' => 0],
                    (object) ['number' => 'A5', 'isBooked' => 0, 'isBlocked' => 0]
                ]
            ]
        ];

        return $mockData;
    }

    private function getMockGreenOceanData($fromLocation, $toLocation)
    {
        // Create mock Green Ocean data for testing
        $mockData = [
            [
                'id' => 'green_ocean_001',
                'tripId' => 'trip_go_001',
                'vesselID' => 'vessel_go_001',
                'departure_time' => '08:00:00',
                'arrival_time' => '10:30:00',
                'ship_name' => 'Green Ocean 1',
                'ship_image' => 'uploads/ship/1722411651.jpg',
                'from' => 'Port Blair',
                'to' => 'Swaraj Dweep (Havelock)',
                'ship' => [
                    'image' => 'uploads/ship/1722411651.jpg',
                    'title' => 'Green Ocean 1',
                    'images' => [
                        [
                            'image_path' => 'uploads/ship/1722411651.jpg'
                        ]
                    ]
                ],
                'pClass' => [
                    (object) [
                        'number' => 'A1',
                        'isBooked' => 0,
                        'isBlocked' => 0
                    ],
                    (object) [
                        'number' => 'A2',
                        'isBooked' => 0,
                        'isBlocked' => 0
                    ],
                    (object) [
                        'number' => 'A3',
                        'isBooked' => 0,
                        'isBlocked' => 0
                    ]
                ],
                'bClass' => [
                    (object) [
                        'number' => 'B1',
                        'isBooked' => 0,
                        'isBlocked' => 0
                    ],
                    (object) [
                        'number' => 'B2',
                        'isBooked' => 0,
                        'isBlocked' => 0
                    ],
                    (object) [
                        'number' => 'B3',
                        'isBooked' => 0,
                        'isBlocked' => 0
                    ]
                ]
            ],
        ];

        return $mockData;
    }
}
