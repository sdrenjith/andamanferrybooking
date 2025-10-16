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
        // Validate required fields
        $fromLocation = $request->form_location;
        $toLocation = $request->to_location;
        $trip_type = $request->input('trip_type');
        $date = $request->input('date');
        
        // Check if required fields are present
        if (!$fromLocation || !$toLocation || !$date) {
            return redirect()->back()->with('error', 'Please fill in all required fields including date selection.');
        }
        
        // Validate date format and check if it's not empty
        if (empty($date) || $date === 'Select Date' || $date === '') {
            return redirect()->back()->with('error', 'Please select a valid date for your journey.');
        }
        
        // For round trips, validate departure and return journey details
        if ($trip_type == 2) {
            $departure_from_location = $request->input('departure_from_location');
            $departure_to_location = $request->input('departure_to_location');
            $departure_date = $request->input('departure_date');
            $return_from_location = $request->input('return_from_location');
            $return_to_location = $request->input('return_to_location');
            $return_date = $request->input('return_date');
            
            // Validate departure journey
            if (empty($departure_from_location) || empty($departure_to_location)) {
                return redirect()->back()->with('error', 'Please select departure journey locations.');
            }
            
            if (empty($departure_date) || $departure_date === 'Select Departure Date' || $departure_date === '') {
                return redirect()->back()->with('error', 'Please select a departure date for your round trip.');
            }
            
            // Validate return journey
            if (empty($return_from_location) || empty($return_to_location)) {
                return redirect()->back()->with('error', 'Please select return journey locations.');
            }
            
            if (empty($return_date) || $return_date === 'Select Return Date' || $return_date === '') {
                return redirect()->back()->with('error', 'Please select a return date for your round trip.');
            }
            
            // Validate that return date is after departure date
            $depDate = strtotime($departure_date);
            $retDate = strtotime($return_date);
            
            if ($retDate <= $depDate) {
                return redirect()->back()->with('error', 'Return date must be after departure date. Please select a return date that is later than your departure date.');
            }
            
            // Additional validation: Check if return date is at least 1 day after departure
            $oneDayAfter = strtotime('+1 day', $depDate);
            if ($retDate < $oneDayAfter) {
                return redirect()->back()->with('error', 'Return date must be at least 1 day after departure date. Please select a valid return date.');
            }
        }

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

        // Cache ferry locations for better performance
        $data['ferry_locations'] = \Cache::remember('ferry_locations', 3600, function () {
            return DB::table('ferry_locations')->where('status', 'Y')->get();
        });

        $date = date('Y-m-d', strtotime(str_replace('/', '-',  $date)));
        $dateCarbon = date('Y-m-d', strtotime($date));

        $no_of_passenger = $request->input('passenger');
        $infant = $request->input('infant');

        // Optimize database query - use simpler query with caching
        $cacheKey = "admin_schedules_{$fromLocation}_{$toLocation}_{$date}";
        $adminShipSchedules = \Cache::remember($cacheKey, 300, function () use ($fromLocation, $toLocation, $date) {
            $oneHourAgo = Carbon::now()->subHour();
            return FerrySchedul::with([
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
        });

        // print_r($adminShipSchedules);die;


        if ($adminShipSchedules) {
            foreach ($adminShipSchedules as $key => $val) {
                $adminShipSchedules[$key]['ship_name'] = 'Admin';
            }
        }

        // Cache location data to avoid multiple database queries
        $fromLocationTitle = \Cache::remember("location_{$fromLocation}", 3600, function () use ($fromLocation) {
            return FerryLocation::where('id', $fromLocation)->first();
        });
        $toLocationTitle = \Cache::remember("location_{$toLocation}", 3600, function () use ($toLocation) {
            return FerryLocation::where('id', $toLocation)->first();
        });

        // Add null checks to prevent "Attempt to read property 'title' on null" error
        if (!$fromLocationTitle || !$toLocationTitle) {
            return redirect()->back()->with('error', 'Invalid location selected. Please try again.');
        }

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

        // Cache ship data to avoid multiple database queries
        $ship1 = \Cache::remember('ship_1_data', 3600, function () {
            return ShipMaster::with('images')->where('id', 1)->first();
        });
        $ship2 = \Cache::remember('ship_2_data', 3600, function () {
            return ShipMaster::with('images')->where('id', 2)->first();
        });
        $ship_image1 = $ship1 ? $ship1->image : '';
        $ship_image2 = $ship2 ? $ship2->image : '';

        // Prepare API calls data
        $data2 = array(
            'date' => date('d-m-Y', strtotime($date)),
            'from' => $fromN,
            'to' =>  $toN,
        );

        $data3 = array("data" => array(
            "trip_type" => "single_trip",
            "from_location" => $fromLocation,
            "travel_date" => date('Y-m-d', strtotime($date)),
            "no_of_passenger" => $no_of_passenger,
            "to_location" => $toLocation,
        ));

        // Make API calls with reduced timeout for faster response
        $nautikaData = [];
        $makData = [];
        $greenOceanData = [];

        // Implement early return strategy - show admin schedules immediately

        // Merge all available data immediately (admin schedules are already loaded)
        $allSchedule = $adminShipSchedules;
        
        // Try to get API data with very short timeouts (5 seconds max)
        try {
            $nautikaData = $this->getNautikaDataFast($data2, $ship_image2, $ship2);
            if (!empty($nautikaData)) {
                $allSchedule = array_merge($allSchedule, $nautikaData);
            }
        } catch (\Exception $e) {
            \Log::info('Nautika API timeout - continuing with admin data only');
        }

        try {
            $makData = $this->getMakruzzDataFast($data3, $ship_image1, $ship1);
            if (!empty($makData)) {
                $allSchedule = array_merge($allSchedule, $makData);
            }
        } catch (\Exception $e) {
            \Log::info('Makruzz API timeout - continuing with available data');
        }

        try {
            $greenOceanData = $this->getGreenOceanDataFast($fromLocation, $toLocation, $no_of_passenger, $infant, $date);
            if (!empty($greenOceanData)) {
                $allSchedule = array_merge($allSchedule, $greenOceanData);
            }
        } catch (\Exception $e) {
            \Log::info('Green Ocean API timeout - continuing with available data');
        }

        // Sort the final schedule
        $collection = collect($allSchedule);
        $sorted = $collection->sortBy(function ($item) {
            return strtotime($item['departure_time'] ?? '23:59:59');
        });

        $data['apiScheduleData'] = $sorted->values()->all();

        // print_r($data['apiScheduleData']);die('test');




        // ********************************** for round 2 Trip ********************************************
        if ($trip_type >= 2) {
            $round1_from_location = $request->departure_from_location;
            $round1_to_location = $request->input('departure_to_location');
            $date = date('Y-m-d', strtotime($request->input('departure_date')));

            // Cache round trip departure schedules
            $cacheKey2 = "admin_schedules_{$round1_from_location}_{$round1_to_location}_{$date}";
            $adminShipSchedules2 = \Cache::remember($cacheKey2, 300, function () use ($round1_from_location, $round1_to_location, $date) {
                $oneHourAgo = Carbon::now()->subHour();
                return FerrySchedul::with([
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
            });



            if ($adminShipSchedules2) {
                foreach ($adminShipSchedules2 as $key => $val) {
                    $adminShipSchedules2[$key]['ship_name'] = 'Admin';
                }
            }

            $round_1_from_location_title = \Cache::remember("location_{$round1_from_location}", 3600, function () use ($round1_from_location) {
                return FerryLocation::where('id', $round1_from_location)->first();
            });
            $round_1_to_location_title = \Cache::remember("location_{$round1_to_location}", 3600, function () use ($round1_to_location) {
                return FerryLocation::where('id', $round1_to_location)->first();
            });

            // Add null checks to prevent "Attempt to read property 'title' on null" error
            if (!$round_1_from_location_title || !$round_1_to_location_title) {
                return redirect()->back()->with('error', 'Invalid location selected. Please try again.');
            }

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

            $ship = \Cache::remember('ship_2_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 2)->first();
            });
            $ship_image = $ship ? $ship->image : '';

            $nautika_result = $this->nautikaApiCallUltraFast('getTripData', $data4);
            $nautikaData2 = [];
            if(!empty($nautika_result) && !empty($nautika_result->data)){
                $nautikaData2 = $nautika_result->data;
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

            $makruzz_result = $this->makApiCallUltraFast('schedule_search', $data5);

            // $ship=DB::table('ship_master')->select('image')->where('id', 1)->first();
            // $ship_image= $ship->image;

            $ship = \Cache::remember('ship_1_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 1)->first();
            });
            $ship_image = $ship ? $ship->image : '';

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
            $greenOceanData = $this->green_ocean_call_ultra_fast($round1_from_location, $round1_to_location, $no_of_passenger, $infant, $date);
            // echo '<pre>';
            // echo "duble <br>";
            // print_r($greenOceanData);
            // die;
            // $greenOceanData = [];
            // dd($greenOceanData);

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
            
            // Process return journey for round trip
            $return_from_location = $request->return_from_location;
            $return_to_location = $request->input('return_to_location');
            $return_date = date('Y-m-d', strtotime($request->input('return_date')));

            // Cache return journey schedules
            $cacheKey3 = "admin_schedules_{$return_from_location}_{$return_to_location}_{$return_date}";
            $adminShipSchedules3 = \Cache::remember($cacheKey3, 300, function () use ($return_from_location, $return_to_location, $return_date) {
                $oneHourAgo = Carbon::now()->subHour();
                return FerrySchedul::with([
                    'ferryPrices' => function ($query) {
                        $query->orderBy('price', 'asc');
                    },
                    'fromLocation',
                    'toLocation',
                    'ship',
                    'ship.images',
                    'ferryPrices.class'
                ])
                    ->where('from_location', $return_from_location)
                    ->where('to_location', $return_to_location)
                    ->where('status', 'Y')
                    ->where('from_date', '<=', $return_date)
                    ->where('to_date', '>=', $return_date)
                    ->when($return_date && $return_date == now()->format('Y-m-d'), function ($query) use ($oneHourAgo) {
                        return $query->where('departure_time', '>=', $oneHourAgo);
                    })
                    ->orderBy('departure_time')
                    ->get()->toArray();
            });

            if ($adminShipSchedules3) {
                foreach ($adminShipSchedules3 as $key => $val) {
                    $adminShipSchedules3[$key]['ship_name'] = 'Admin';
                }
            }

            $return_from_location_title = \Cache::remember("location_{$return_from_location}", 3600, function () use ($return_from_location) {
                return FerryLocation::where('id', $return_from_location)->first();
            });
            $return_to_location_title = \Cache::remember("location_{$return_to_location}", 3600, function () use ($return_to_location) {
                return FerryLocation::where('id', $return_to_location)->first();
            });

            // Add null checks to prevent "Attempt to read property 'title' on null" error
            if (!$return_from_location_title || !$return_to_location_title) {
                return redirect()->back()->with('error', 'Invalid location selected for return journey. Please try again.');
            }

            $data['return_route_titles'] = [
                'from_location' => $return_from_location_title->title,
                'to_location' => $return_to_location_title->title,
            ];

            // Process return journey API calls similar to departure journey
            $return_from_location_title = '';
            $return_to_location_title = '';

            if ($return_from_location == 1) {
                $return_from_location_title = 'Port Blair';
            } elseif ($return_from_location == 2) {
                $return_from_location_title = 'Swaraj Dweep';
            } elseif ($return_from_location == 3) {
                $return_from_location_title = 'Shaheed Dweep';
            }

            if ($return_to_location == 1) {
                $return_to_location_title = 'Port Blair';
            } elseif ($return_to_location == 2) {
                $return_to_location_title = 'Swaraj Dweep';
            } elseif ($return_to_location == 3) {
                $return_to_location_title = 'Shaheed Dweep';
            }

            $return_data = array(
                'date' => date('d-m-Y', strtotime($return_date)),
                'from' => $return_from_location_title,
                'to' => $return_to_location_title
            );

            $ship = \Cache::remember('ship_2_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 2)->first();
            });
            $ship_image = $ship ? $ship->image : '';

            $nautika_return_result = $this->nautikaApiCallUltraFast('getTripData', $return_data);
            $nautikaReturnData = [];
            if(!empty($nautika_return_result) && !empty($nautika_return_result->data)){
                $nautikaReturnData = $nautika_return_result->data;
            }
            
            if (!empty($nautikaReturnData)) {
                foreach ($nautikaReturnData as $key => $val) {
                    $nautikaReturnData[$key] = (array) $val;
                    $nautikaReturnData[$key]['ship_name'] = 'Nautika';
                    $nautikaReturnData[$key]['ship_image'] = $ship_image;
                    $nautikaReturnData[$key]['ship'] = $ship;
                    $nautikaReturnData[$key]['departure_time'] = str_pad($val->dTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->dTime->minute . ':00';
                    $nautikaReturnData[$key]['arrival_time'] = str_pad($val->aTime->hour, 2, '0', STR_PAD_LEFT)  . ':' . $val->aTime->minute . ':00';
                    $nautikaReturnData[$key]['b_class_seat_availibility'] = 0;
                    $nautikaReturnData[$key]['p_class_seat_availibility'] = 0;
                    foreach ($val->bClass as $key1 => $val1) {
                        if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                            $nautikaReturnData[$key]['b_class_seat_availibility']++;
                        }
                    }
                    foreach ($val->pClass as $key1 => $val1) {
                        if ($val1->isBooked == 0 && $val1->isBlocked == 0) {
                            $nautikaReturnData[$key]['p_class_seat_availibility']++;
                        }
                    }
                }
            }

            $return_mak_data = array("data" => array(
                "trip_type" => "single_trip",
                "from_location" => $return_from_location,
                "travel_date" => date('Y-m-d', strtotime($return_date)),
                "no_of_passenger" => $no_of_passenger,
                "to_location" => $return_to_location,
            ));

            $makruzz_return_result = $this->makApiCallUltraFast('schedule_search', $return_mak_data);

            $ship = \Cache::remember('ship_1_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 1)->first();
            });
            $ship_image = $ship ? $ship->image : '';

            $makReturnData = [];
            if (!empty($makruzz_return_result) && !empty($makruzz_return_result->data)) {
                $makFerry = $makruzz_return_result->data;
                foreach ($makFerry as $key => $val) {
                    $makReturnData[$val->id]['id'] =  $val->id;
                    $makReturnData[$val->id]['departure_time'] =  $val->departure_time;
                    $makReturnData[$val->id]['ship_name'] =  'Makruzz';
                    $makReturnData[$val->id]['ship_image'] = $ship_image;
                    $makReturnData[$val->id]['ship'] = $ship;
                    $makReturnData[$val->id]['ship_class'][] =  $val;
                }
            }

            // Green Ocean call for return journey
            $greenOceanReturnData = $this->green_ocean_call_ultra_fast($return_from_location, $return_to_location, $no_of_passenger, $infant, $return_date);

            if (!empty($nautikaReturnData)) {
                $allReturnSchedule = array_merge($makReturnData, $nautikaReturnData);
            } else {
                $allReturnSchedule = $makReturnData;
            }

            $allReturnSchedule3 = array_merge($allReturnSchedule, $greenOceanReturnData);

            if(!empty($adminShipSchedules3)){
                $allReturnSchedule3 = array_merge($allReturnSchedule3, $adminShipSchedules3);
            }

            $collection = collect($allReturnSchedule3);
            // Sort the collection by 'time' column
            $sorted = $collection->sortBy(function ($item) {
                return strtotime($item['departure_time']);
            });

            $sortedReturnArray = $sorted->values()->all();

            $data['apiScheduleData3'] = $sortedReturnArray;
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
            
            // Add null checks to prevent "Attempt to read property 'title' on null" error
            if (!$round_2_from_location_title || !$round_2_to_location_title) {
                return redirect()->back()->with('error', 'Invalid location selected for return journey. Please try again.');
            }
            
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

            $ship = \Cache::remember('ship_2_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 2)->first();
            });
            $ship_image = $ship ? $ship->image : '';

            $nautika_result2 = $this->nautikaApiCall('getTripData', $data6);

            if(!empty($nautika_result2)){
                $nautikaData3 = $nautika_result2->data;
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

            $ship = \Cache::remember('ship_1_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 1)->first();
            });
            $ship_image = $ship ? $ship->image : '';

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
            // $greenOceanData = [];
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
            'departure_from_location' => $request->departure_from_location,
            'departure_to_location' => $request->departure_to_location,
            'departure_date' => date('Y-m-d', strtotime($request->departure_date)),
            'return_from_location' => $request->return_from_location,
            'return_to_location' => $request->return_to_location,
            'return_date' => date('Y-m-d', strtotime($request->return_date)),
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
                        $scheduleSeats = $row['pClass'];
                    }
                }
                $shipClass = 'luxury';
            } else if ($request->shipClass == 'bClass') {
                foreach ($schedule as $row) {
                    if ($row['id'] == $request->scheduleId) {
                        $scheduleSeats = $row['bClass'];
                    }
                }
                $shipClass = 'royal';
            }

            echo json_encode(array('seats' => $scheduleSeats, 'ship_class' => $shipClass));
        } else {
            echo json_encode(array('status' => 'success'));
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

    public function green_ocean_call_fast($fromLocation, $toLocation, $no_of_passenger, $infant, $date)
    {
        $hash_sequence = "from_id|dest_to|number_of_adults|number_of_infants|travel_date|public_key";
        $godata['from_id'] = $fromLocation;
        $godata['dest_to'] = $toLocation;
        $godata['number_of_adults'] = $no_of_passenger; // No of Adults
        $godata['number_of_infants'] = $infant; // No. of Infant
        $godata['travel_date'] = date('Y-m-d', strtotime($date)); // Travel Date as DD-MM-YYYY 
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string 

        $result = $this->greenOceanApiCallFast('route-details', $godata);

        $greenOceanData = [];
        if (!empty($result->status) && ($result->status == 'success')) {
            // Cache ship data to avoid multiple queries
            $ship1 = \Cache::remember('ship_3_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 3)->first();
            });
            $ship2 = \Cache::remember('ship_4_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 4)->first();
            });
            $ship_image1 = $ship1 ? $ship1->image : '';
            $ship_image2 = $ship2 ? $ship2->image : '';

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

    public function green_ocean_call_ultra_fast($fromLocation, $toLocation, $no_of_passenger, $infant, $date)
    {
        $hash_sequence = "from_id|dest_to|number_of_adults|number_of_infants|travel_date|public_key";
        $godata['from_id'] = $fromLocation;
        $godata['dest_to'] = $toLocation;
        $godata['number_of_adults'] = $no_of_passenger; // No of Adults
        $godata['number_of_infants'] = $infant; // No. of Infant
        $godata['travel_date'] = date('Y-m-d', strtotime($date)); // Travel Date as DD-MM-YYYY 
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string 

        $result = $this->greenOceanApiCallUltraFast('route-details', $godata);

        $greenOceanData = [];
        if (!empty($result->status) && ($result->status == 'success')) {
            // Cache ship data to avoid multiple queries
            $ship1 = \Cache::remember('ship_3_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 3)->first();
            });
            $ship2 = \Cache::remember('ship_4_data', 3600, function () {
                return ShipMaster::with('images')->where('id', 4)->first();
            });
            $ship_image1 = $ship1 ? $ship1->image : '';
            $ship_image2 = $ship2 ? $ship2->image : '';

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

    // Helper methods for optimized API processing
    private function processNautikaApiCall($data2, &$nautikaData, $ship_image2, $ship2)
    {
        try {
            $result2 = $this->nautikaApiCallFast('getTripData', $data2);
            if(!empty($result2) && !empty($result2->data)){
                $nautikaData = $result2->data;
                foreach ($nautikaData as $key => $val) {
                    $nautikaData[$key] = (array) $val;
                    $nautikaData[$key]['ship_name'] = 'Nautika';
                    $nautikaData[$key]['ship_image'] = $ship_image2;
                    $nautikaData[$key]['ship'] = $ship2;
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
        } catch (\Exception $e) {
            \Log::warning('Nautika API call failed: ' . $e->getMessage());
        }
    }

    private function processMakruzzApiCall($data3, &$makData, $ship_image1, $ship1)
    {
        try {
            $result = $this->makApiCallFast('schedule_search', $data3);
            if (!empty($result) && !empty($result->data)) {
                $makFerry = $result->data;
                foreach ($makFerry as $key => $val) {
                    $makData[$val->id]['id'] =  $val->id;
                    $makData[$val->id]['departure_time'] =  $val->departure_time;
                    $makData[$val->id]['ship_name'] =  'Makruzz';
                    $makData[$val->id]['ship_image'] = $ship_image1;
                    $makData[$val->id]['ship'] = $ship1;
                    $makData[$val->id]['ship_class'][] =  $val;
                }
            }
        } catch (\Exception $e) {
            \Log::warning('Makruzz API call failed: ' . $e->getMessage());
        }
    }

    private function processGreenOceanApiCall($fromLocation, $toLocation, $no_of_passenger, $infant, $date, &$greenOceanData)
    {
        try {
            $greenOceanData = $this->green_ocean_call_fast($fromLocation, $toLocation, $no_of_passenger, $infant, $date);
        } catch (\Exception $e) {
            \Log::warning('Green Ocean API call failed: ' . $e->getMessage());
        }
    }

    // Ultra-fast data retrieval methods with 5-second timeouts
    private function getNautikaDataFast($data2, $ship_image2, $ship2)
    {
        $result2 = $this->nautikaApiCallUltraFast('getTripData', $data2);
        $nautikaData = [];
        
        if(!empty($result2) && !empty($result2->data)){
            $nautikaData = $result2->data;
            foreach ($nautikaData as $key => $val) {
                $nautikaData[$key] = (array) $val;
                $nautikaData[$key]['ship_name'] = 'Nautika';
                $nautikaData[$key]['ship_image'] = $ship_image2;
                $nautikaData[$key]['ship'] = $ship2;
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
        
        return $nautikaData;
    }

    private function getMakruzzDataFast($data3, $ship_image1, $ship1)
    {
        $result = $this->makApiCallUltraFast('schedule_search', $data3);
        $makData = [];
        
        if (!empty($result) && !empty($result->data)) {
            $makFerry = $result->data;
            foreach ($makFerry as $key => $val) {
                $makData[$val->id]['id'] =  $val->id;
                $makData[$val->id]['departure_time'] =  $val->departure_time;
                $makData[$val->id]['ship_name'] =  'Makruzz';
                $makData[$val->id]['ship_image'] = $ship_image1;
                $makData[$val->id]['ship'] = $ship1;
                $makData[$val->id]['ship_class'][] =  $val;
            }
        }
        
        return $makData;
    }

    private function getGreenOceanDataFast($fromLocation, $toLocation, $no_of_passenger, $infant, $date)
    {
        return $this->green_ocean_call_ultra_fast($fromLocation, $toLocation, $no_of_passenger, $infant, $date);
    }

    public function getGreenShipLayout(Request $request)
    {
        $bookingScheduleDetails = Session::get('booking_data');
        $fromLocation = $bookingScheduleDetails['form_location'];
        $toLocation = $bookingScheduleDetails['to_location'];
        $date = $bookingScheduleDetails['date'];
        
        if ($request->trip == 2) {
            $fromLocation = $bookingScheduleDetails['departure_from_location'];
            $toLocation = $bookingScheduleDetails['departure_to_location'];
            $date = $bookingScheduleDetails['departure_date'];
        }
        
        if ($request->trip == 3) {
            $fromLocation = $bookingScheduleDetails['return_from_location'];
            $toLocation = $bookingScheduleDetails['return_to_location'];
            $date = $bookingScheduleDetails['return_date'];
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
            $fromLocation = $bookingScheduleDetails['departure_from_location'];
            $toLocation = $bookingScheduleDetails['departure_to_location'];
            $date = $bookingScheduleDetails['departure_date'];
        }
        
        if ($trip == 3) {
            $fromLocation = $bookingScheduleDetails['return_from_location'];
            $toLocation = $bookingScheduleDetails['return_to_location'];
            $date = $bookingScheduleDetails['return_date'];
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
}
