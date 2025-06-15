<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use App\Models\RazorpayPaymentDetail;
use Illuminate\Support\Str;
use App\Models\FerrySchedul;
use App\Models\FerryLocation;
use App\Models\FerrySchedulePrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\GreenMail;
use Illuminate\Support\Facades\Http;

use Barryvdh\DomPDF\Facade\Pdf;



class BookingController extends Controller
{
    public function booking_show_boat(Request $request)
    {

        $data['boatScheduleId'] = $request->query('boatScheduleId');
        $data['date'] = $request->query('date');
        $date = Carbon::parse($data['date']);
        $data['formattedDate'] = $date->format('D, d M, Y');
        $data['passengers'] = $request->query('passengers');
        $data['infants'] = $request->query('infants');


        $data['boat_datas'] = DB::table('boat_schedule')
            ->where('id', $data['boatScheduleId'])
            ->where('status', 'Y')
            ->first();

        if (!empty($data['boat_datas'])) {
            if ($data['boat_datas']->is_chartered_boat == 'Y') {
                $boat_price_detail = DB::table('boat_schedule_price')->where(['boat_schedule_id' => $data['boatScheduleId'], 'no_of_passenger' => $data['passengers']])->first();

                $data['boat_price'] = $boat_price_detail->per_passenger_price;

                $data['multi_price'] =   $data['boat_price'] * $data['passengers'];
            } else {
                $data['boat_price'] = $data['boat_datas']->price;
                $data['multi_price'] =   $data['boat_price'] * $data['passengers'];
            }
        }

        return view('booking.bokingpage.booking-summary-boat', $data);
    }



    public function boat_booking(Request $request)
    {

        $rand_number = rand(100, 999);

        $timestamp = time();
        $timestamp_last7 = substr($timestamp, -7);
        $combined = $rand_number . $timestamp_last7;

        $orderId = substr($combined, 0, 10);

        $user = Auth::user();
        $user_id = $user->id ?? NULL;

        $lastInsertedId = DB::table('booking')->insertGetId([
            'schedule_id' => $request->boatScheduleId,
            'type' => $request->type,
            'order_id' => $orderId,
            'c_name' => $request->c_name,
            'c_email' => $request->c_email,
            'c_mobile' => $request->c_mobile,
            'c_contact' => $request->c_contact,
            'payment_status' => 'pending',
            'ship_name' => $request->boat_name ?? NUll,
            'amount'         => $request->amount,
            'no_of_passenger' => $request->no_of_passenger,
            'date_of_jurney'  => $request->date_of_jurney,
            'user_id'  =>  $user_id
        ]);

        if (!empty($lastInsertedId)) {
            $passengerTitles = $request->input('passenger_title');
            $passengerNames = $request->input('passenger_name');
            $passengerDobs = $request->input('passenger_dob');
            $passengerGenders = $request->input('passenger_gender');
            $passengerNationalities = $request->input('passenger_nationality');
            $country_name = $request->input('country_name');
            $passport_id = $request->input('passport_id');
            $expiry_date = $request->input('expiry_date');


            if (
                is_array($passengerTitles) && is_array($passengerNames) && is_array($passengerDobs) && is_array($passengerGenders) && is_array($passengerNationalities) &&
                count($passengerTitles) === count($passengerNames) && count($passengerNames) === count($passengerDobs) && count($passengerDobs) === count($passengerGenders) && count($passengerGenders) === count($passengerNationalities)
            ) {

                foreach ($passengerTitles as $index => $title) {
                    //$fullName = $title . ' ' . $passengerNames[$index];
                    $passengerData = [
                        'booking_id' => $lastInsertedId,
                        'title' => $passengerTitles[$index],
                        'full_name' => $passengerNames[$index],
                        'dob' => $passengerDobs[$index],
                        'gender' => $passengerGenders[$index],
                        'resident' => $passengerNationalities[$index],
                        'country' => $country_name[$index] ?? 'India',
                        'passport_id' => $passport_id[$index],
                        'expiry_date' => $expiry_date[$index],
                        'trip_type' => 'Boat',
                    ];

                    DB::table('booking_passenger_details')->insert($passengerData);
                }

                $api_key  = env("RAZOR_KEY_ID");
                $api_secret = env("RAZOR_KEY_SECRET");
                $total_amount = $request->amount;
                $mobile  = $request->c_mobile;
                $name = $request->c_name;
                $email = $request->c_email;
                $user_id = $lastInsertedId;

                $api = new Api($api_key, $api_secret);

                $order = $api->order->create(array('receipt' => '123', 'amount' => $total_amount * 100, 'currency' => 'INR'));
                $order_id = $order['id'];

                Session::put('order_id', $order_id);
                Session::put('amount', $total_amount);
                Session::put('user_phone', $mobile);
                Session::put('user_email', $email);
                Session::put('user_name', $name);
                Session::put('booking_id', $lastInsertedId);

                return view('razorpay.payment', compact('user_id', 'order_id'));


                // return redirect()->back()->with('success', 'Booking created successfully.');
            } else {
                return redirect()->back()->with('error', 'Passenger details are incomplete or mismatched.');
            }
        }

        return redirect()->back()->with('error', 'Booking creation failed.');
    }


    public function booking_show_ferry(Request $request)
    {
        $booking_data = Session::get('booking_data');
        $data['booking_data'] = $booking_data;
        $ferry_list = Session::get('ferry_list');


        if (!empty($request->booking_data)) {
            $booking_data_str = $request->booking_data;
            $booking_data = json_decode($booking_data_str);

            if (!empty($booking_data)) {
                $data['booking_data'] = $booking_data;
            }
        }

        // dd($booking_data);

        if (!empty($booking_data) && !empty($ferry_list)) {

            // ===================== TRIP 1 ==================================
            $trip1FerryList = $ferry_list['apiScheduleData'];
            $ferryScheduleId = $booking_data['schedule'][1]['scheduleId'];
            $ferryScheduleType = $booking_data['schedule'][1]['ship'];
            // $ferryScheduleType = $booking_data['schedule'][0]['tripSeatNo'];

            //print_r($trip1FerryList);die;

            // dd($trip1FerryList);
            $passenger = $booking_data['no_of_passenger'];
            $infants = $booking_data['no_of_infant'];

            foreach ($trip1FerryList as $row) {
                if ($row['id'] == $ferryScheduleId && $row['ship_name'] == $ferryScheduleType) {
                    $scheduleDet1 = $row;
                }
            }

            // dd($scheduleDet1);

            $selectedSche1 = [];

            if ($scheduleDet1['ship_name'] == 'Admin') {
                foreach ($scheduleDet1['ferry_prices'] as $row) {
                    if ($row['class_id'] == $booking_data['schedule'][1]['shipClass']) {
                        // $selectedSche1['fare'] = $row['price'];
                        $selectedSche1['fare'] = 200;
                        $selectedSche1['class_title'] = $row['class']['title'];
                    }
                }

                $selectedSche1['class_id'] = $booking_data['schedule'][1]['shipClass'];
                $selectedSche1['schedule_id'] = $booking_data['schedule'][1]['scheduleId'];
                $selectedSche1['trip_id'] = NULL;
                $selectedSche1['ship_name'] = $scheduleDet1['ship']['title'];
                $selectedSche1['departure_time'] = $scheduleDet1['departure_time'];
                $selectedSche1['arrival_time'] = $scheduleDet1['arrival_time'];
                // $selectedSche1['psf'] = 50;
                $selectedSche1['psf'] = 0;
                $selectedSche1['route_id'] = NULL;
            } else if ($scheduleDet1['ship_name'] == 'Nautika') {
                if ($booking_data['schedule'][1]['shipClass'] == 'bClass') {
                    $selectedSche1['fare'] = $scheduleDet1['fares']->bBaseFare;
                    $selectedSche1['class_title'] = 'bClass';
                } else if ($booking_data['schedule'][1]['shipClass'] == 'pClass') {
                    $selectedSche1['fare'] = $scheduleDet1['fares']->pBaseFare;
                    $selectedSche1['class_title'] = 'bClass';
                }
                $selectedSche1['infantFare'] = $scheduleDet1['fares']->infantFare;
                $selectedSche1['schedule_id'] = $scheduleDet1['id'];
                $selectedSche1['class_id'] = $booking_data['schedule'][1]['shipClass'];
                $selectedSche1['ship_name'] = $scheduleDet1['ship_name'];
                // $selectedSche1['from_location'] = $booking_data1['from'];
                // $selectedSche1['to_location'] = $booking_data1['to'];
                $selectedSche1['departure_time'] = $scheduleDet1['departure_time'];
                $selectedSche1['arrival_time'] = $scheduleDet1['arrival_time'];
                $selectedSche1['trip_id'] = $scheduleDet1['tripId'];
                $selectedSche1['vesselID'] = $scheduleDet1['vesselID'];
                $selectedSche1['psf'] = 50;
                $selectedSche1['route_id'] = NULL;

                $selectedSche1['tripSeatNo'] = $booking_data['schedule'][1]['tripSeatNo'];
            } else if ($scheduleDet1['ship_name'] == 'Makruzz') {
                $selectedSche1['class_id'] = $booking_data['schedule'][1]['shipClass'];
                $selectedSche1['schedule_id'] = $booking_data['schedule'][1]['scheduleId'];
                $selectedSche1['trip_id'] = NULL;
                $selectedSche1['ship_name'] = $scheduleDet1['ship_name'];
                $selectedSche1['departure_time'] = $scheduleDet1['departure_time'];
                $selectedSche1['arrival_time'] = $scheduleDet1['ship_class'][0]->arrival_time;
                $selectedSche1['fare'] = $scheduleDet1['ship_class'][0]->arrival_time;
                $selectedSche1['route_id'] = NULL;
                foreach ($scheduleDet1['ship_class'] as $sch) {
                    if ($sch->ship_class_id == $booking_data['schedule'][1]['shipClass']) {
                        $selectedSche1['fare'] = $sch->ship_class_price;
                        $selectedSche1['psf'] = $sch->psf;
                        $selectedSche1['class_title'] = $sch->psf;
                        $selectedSche1['class_title'] = $sch->ship_class_title;
                    }
                }
            } else if (str_contains($scheduleDet1['ship_name'], 'Green Ocean')) {
                // dd($booking_data['schedule']);
                $selectedSche1['class_id'] = $booking_data['schedule'][1]['shipClass'];
                $selectedSche1['schedule_id'] = $booking_data['schedule'][1]['scheduleId'];
                $selectedSche1['trip_id'] = NULL;
                $selectedSche1['ship_id'] = $booking_data['schedule'][1]['ship_id'];
                $selectedSche1['ship_name'] = $scheduleDet1['ship_name'];
                $selectedSche1['departure_time'] = $scheduleDet1['departure_time'];
                // $selectedSche1['arrival_time'] = $scheduleDet1['ship_class'][0]->arrival_time;
                $selectedSche1['arrival_time'] = $scheduleDet1['arraival_time'];
                // $selectedSche1['fare'] = $scheduleDet1['ship_class'][0]->arrival_time;
                $selectedSche1['route_id'] = $booking_data['schedule'][1]['route_id'];
                $selectedSche1['trip_seat_no'] = $booking_data['schedule'][1]['tripSeatNo'];

                foreach ($scheduleDet1['ship_class'] as $sch) {
                    if ($sch->class_id == $booking_data['schedule'][1]['shipClass']) {
                        $selectedSche1['fare'] = $sch->adult_seat_rate;
                        $selectedSche1['psf'] = $sch->port_fee;
                        // $selectedSche1['class_title'] = $sch->psf;
                        $selectedSche1['class_title'] = $sch->class_name;
                    }
                }
            }

            $data['trip1'] = $selectedSche1;


            // ============================ TRIP 2 =====================================================
            if ($booking_data['trip_type'] >= 2) {
                $trip2FerryList = $ferry_list['apiScheduleData2'];
                $ferryScheduleId = $booking_data['schedule'][2]['scheduleId'];
                $ferryScheduleType = $booking_data['schedule'][2]['ship'];

                foreach ($trip2FerryList as $row) {
                    if ($row['id'] == $ferryScheduleId && $row['ship_name'] == $ferryScheduleType) {
                        $scheduleDet2 = $row;
                    }
                }

                $selectedSche2 = [];
                // print_r($scheduleDet2);die;
                if ($scheduleDet2['ship_name'] == 'Admin') {
                    foreach ($scheduleDet2['ferry_prices'] as $row) {
                        if ($row['class_id'] == $booking_data['schedule'][2]['shipClass']) {
                            // $selectedSche2['fare'] = $row['price'];
                            $selectedSche2['fare'] = 200;
                            $selectedSche2['class_title'] = $row['class']['title'];
                        }
                    }

                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['schedule_id'] = $booking_data['schedule'][2]['scheduleId'];
                    $selectedSche2['trip_id'] = NULL;
                    $selectedSche2['ship_name'] = $scheduleDet2['ship']['title'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    $selectedSche2['arrival_time'] = $scheduleDet2['arrival_time'];
                    // $selectedSche2['psf'] = 50;
                    $selectedSche2['psf'] = 0;
                    $selectedSche2['route_id'] = NULL;

                } else if ($scheduleDet2['ship_name'] == 'Nautika') {
                    if ($booking_data['schedule'][2]['shipClass'] == 'bClass') {
                        $selectedSche2['fare'] = $scheduleDet2['fares']->bBaseFare;
                        $selectedSche2['class_title'] = 'bClass';
                    } else if ($booking_data['schedule'][2]['shipClass'] == 'pClass') {
                        $selectedSche2['fare'] = $scheduleDet2['fares']->pBaseFare;
                        $selectedSche2['class_title'] = 'bClass';
                    }
                    $selectedSche2['infantFare'] = $scheduleDet2['fares']->infantFare;
                    $selectedSche2['schedule_id'] = $scheduleDet2['id'];
                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['ship_name'] = $scheduleDet2['ship_name'];
                    // $selectedSche2['from_location'] = $booking_data1['from'];
                    // $selectedSche2['to_location'] = $booking_data1['to'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    $selectedSche2['arrival_time'] = $scheduleDet2['arrival_time'];
                    $selectedSche2['trip_id'] = $scheduleDet2['tripId'];
                    $selectedSche2['vesselID'] = $scheduleDet2['vesselID'];
                    $selectedSche2['route_id'] = NULL;
                    $selectedSche2['psf'] = 50;
                    $selectedSche2['tripSeatNo'] = $booking_data['schedule'][2]['tripSeatNo'];
                } else if ($scheduleDet2['ship_name'] == 'Makruzz') {
                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['schedule_id'] = $booking_data['schedule'][2]['scheduleId'];
                    $selectedSche2['trip_id'] = NULL;
                    $selectedSche2['ship_name'] = $scheduleDet2['ship_name'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    $selectedSche2['arrival_time'] = $scheduleDet2['ship_class'][0]->arrival_time;
                    $selectedSche2['route_id'] = NULL;

                    foreach ($scheduleDet2['ship_class'] as $sch) {
                        if ($sch->ship_class_id == $booking_data['schedule'][2]['shipClass']) {
                            $selectedSche2['fare'] = $sch->ship_class_price;
                            $selectedSche2['psf'] = $sch->psf;
                            $selectedSche2['class_title'] = $sch->ship_class_title;
                        }
                    }
                } else if (str_contains($scheduleDet2['ship_name'], 'Green Ocean')) {
                    // dd($booking_data['schedule']);
                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['schedule_id'] = $booking_data['schedule'][2]['scheduleId'];
                    $selectedSche2['trip_id'] = NULL;
                    // $selectedSche2['ship_id'] = $scheduleDet2['ship_id'];
                    $selectedSche2['ship_id'] = $booking_data['schedule'][2]['ship_id'];

                    $selectedSche2['ship_name'] = $scheduleDet2['ship_name'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    // $selectedSche2['arrival_time'] = $scheduleDet2['ship_class'][0]->arrival_time;
                    $selectedSche2['arrival_time'] = $scheduleDet2['arraival_time'];
                    // $selectedSche2['fare'] = $scheduleDet2['ship_class'][0]->arrival_time;
                    $selectedSche2['route_id'] = $booking_data['schedule'][2]['route_id'];

                    $selectedSche2['trip_seat_no'] = $booking_data['schedule'][2]['tripSeatNo'];

                    foreach ($scheduleDet2['ship_class'] as $sch) {
                        if ($sch->class_id == $booking_data['schedule'][2]['shipClass']) {
                            $selectedSche2['fare'] = $sch->adult_seat_rate;
                            $selectedSche2['psf'] = $sch->port_fee;
                            // $selectedSche2['class_title'] = $sch->psf;
                            $selectedSche2['class_title'] = $sch->class_name;
                        }
                    }
                }

                $data['trip2'] = $selectedSche2;
            }

            // ============================ TRIP 2 =====================================================
            if ($booking_data['trip_type'] == 3) {

                $trip3FerryList = $ferry_list['apiScheduleData3'];

                $ferryScheduleId = $booking_data['schedule'][3]['scheduleId'];
                $ferryScheduleType = $booking_data['schedule'][3]['ship'];

                foreach ($trip3FerryList as $row) {
                    if ($row['id'] == $ferryScheduleId && $row['ship_name'] == $ferryScheduleType) {
                        $scheduleDet3 = $row;
                    }
                }
                $selectedSche3 = [];

                if ($scheduleDet3['ship_name'] == 'Admin') {
                    foreach ($scheduleDet3['ferry_prices'] as $row) {
                        if ($row['class_id'] == $booking_data['schedule'][3]['shipClass']) {
                            // $selectedSche3['fare'] = $row['price'];
                            $selectedSche3['fare'] = 200;
                            $selectedSche3['class_title'] = $row['class']['title'];
                        }
                    }

                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['schedule_id'] = $booking_data['schedule'][3]['scheduleId'];
                    $selectedSche3['trip_id'] = NULL;
                    $selectedSche3['ship_name'] = $scheduleDet3['ship']['title'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    $selectedSche3['arrival_time'] = $scheduleDet3['arrival_time'];
                    // $selectedSche3['psf'] = 50;
                    $selectedSche3['psf'] = 0;
                    $selectedSche3['route_id'] = NULL;

                } else if ($scheduleDet3['ship_name'] == 'Nautika') {
                    if ($booking_data['schedule'][3]['shipClass'] == 'bClass') {
                        $selectedSche3['fare'] = $scheduleDet3['fares']->bBaseFare;
                        $selectedSche3['class_title'] = 'bClass';
                    } else if ($booking_data['schedule'][3]['shipClass'] == 'pClass') {
                        $selectedSche3['fare'] = $scheduleDet3['fares']->pBaseFare;
                        $selectedSche3['class_title'] = 'bClass';
                    }
                    $selectedSche3['infantFare'] = $scheduleDet3['fares']->infantFare;
                    $selectedSche3['schedule_id'] = $scheduleDet3['id'];
                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['ship_name'] = $scheduleDet3['ship_name'];
                    // $selectedSche3['from_location'] = $booking_data1['from'];
                    // $selectedSche3['to_location'] = $booking_data1['to'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    $selectedSche3['arrival_time'] = $scheduleDet3['arrival_time'];
                    $selectedSche3['trip_id'] = $scheduleDet3['tripId'];
                    $selectedSche3['vesselID'] = $scheduleDet3['vesselID'];
                    $selectedSche3['psf'] = 50;
                    $selectedSche3['tripSeatNo'] = $booking_data['schedule'][3]['tripSeatNo'];
                    $selectedSche3['route_id'] = NULL;
                } else if ($scheduleDet3['ship_name'] == 'Makruzz') {

                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['schedule_id'] = $booking_data['schedule'][3]['scheduleId'];
                    $selectedSche3['trip_id'] = NULL;
                    $selectedSche3['ship_name'] = $scheduleDet3['ship_name'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    $selectedSche3['arrival_time'] = $scheduleDet3['ship_class'][0]->arrival_time;
                    $selectedSche3['route_id'] = NULL;
                    foreach ($scheduleDet3['ship_class'] as $sch) {
                        if ($sch->ship_class_id == $booking_data['schedule'][3]['shipClass']) {
                            $selectedSche3['fare'] = $sch->ship_class_price;
                            $selectedSche3['psf'] = $sch->psf;
                            $selectedSche3['class_title'] = $sch->ship_class_title;
                        }
                    }
                } else if (str_contains($scheduleDet3['ship_name'], 'Green Ocean')) {
                    // dd($booking_data['schedule']);
                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['schedule_id'] = $booking_data['schedule'][3]['scheduleId'];
                    $selectedSche3['trip_id'] = NULL;
                    // $selectedSche3['ship_id'] = $scheduleDet3['ship_id'];
                    $selectedSche3['ship_id'] = $booking_data['schedule'][3]['ship_id'];
                    $selectedSche3['ship_name'] = $scheduleDet3['ship_name'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    // $selectedSche3['arrival_time'] = $scheduleDet3['ship_class'][0]->arrival_time;
                    $selectedSche3['arrival_time'] = $scheduleDet3['arraival_time'];
                    // $selectedSche3['fare'] = $scheduleDet3['ship_class'][0]->arrival_time;
                    $selectedSche3['route_id'] = $booking_data['schedule'][3]['route_id'];
                    $selectedSche3['trip_seat_no'] = $booking_data['schedule'][3]['tripSeatNo'];
                    foreach ($scheduleDet3['ship_class'] as $sch) {
                        if ($sch->class_id == $booking_data['schedule'][3]['shipClass']) {
                            $selectedSche3['fare'] = $sch->adult_seat_rate;
                            $selectedSche3['psf'] = $sch->port_fee;
                            // $selectedSche3['class_title'] = $sch->psf;
                            $selectedSche3['class_title'] = $sch->class_name;
                        }
                    }
                }

                $data['trip3'] = $selectedSche3;
            }
            // print_r($selectedSche1);
            // echo '<br>';
            // print_r($selectedSche2);
            // echo '<br>';
            // print_r($selectedSche3);
            // die;

            // dd($data);

            Session::put('trip_data', $data);

            return view('booking.bokingpage.booking-summary-ferry', $data);
        }
    }


    public function ferry_booking(Request $request)
    {

        $rand_number = rand(100, 999);
        $timestamp = time();
        $timestamp_last7 = substr($timestamp, -7);
        $combined = $rand_number . $timestamp_last7;
        $trip_type = $request->type;

        $orderId = substr($combined, 0, 10);

        $user = Auth::user();
        $user_id = $user->id ?? NULL;
        $trip_data = Session::get('trip_data');

        // dd(Session::get('booking_data'));

        // print_r(  $trip_data);
        // die();
        if (isset($trip_data['trip1'])) {
            $trip1_booking_id = DB::table('booking')->insertGetId([
                'schedule_id' => $trip_data['trip1']['schedule_id'],
                'type' => $request->type,
                'order_id' => $orderId,
                'c_name' => $request->c_name,
                'c_email' => $request->c_email,
                'c_mobile' => $request->c_mobile,
                'c_contact' => $request->c_contact,
                'payment_status' => 'pending',
                'amount'         => Session::get('total_trip1_amount'),
                'no_of_passenger' => $trip_data['booking_data']['no_of_passenger'],
                'date_of_jurney'  => $trip_data['booking_data']['date'],
                //'return_date'  => $request->return_date,
                'trip_id'  => $trip_data['trip1']['trip_id'],
                'route_id'  => $trip_data['trip1']['route_id'], // for green ocean
                'vessel_id'  => $trip_data['trip1']['vesselID'] ?? NULL,
                'departure_time'  => $trip_data['trip1']['departure_time'],
                'arrival_time'  => $trip_data['trip1']['arrival_time'],
                'nautika_class'  =>  $trip_data['trip1']['ship_name'] == 'Nautika' ? $trip_data['trip1']['class_id'] : NULL,
                'makruzz_class'  => $trip_data['trip1']['ship_name'] == 'Makruzz' ? $trip_data['trip1']['class_id'] : NULL,
                'green_ocean_class'  => $trip_data['booking_data']['schedule'][1] == 'Admin' ? $trip_data['trip1']['class_id'] : NULL,
                'ferry_class'  => $trip_data['trip1']['class_title'],
                'from_location'  => $trip_data['booking_data']['form_location'],
                'to_location'  => $trip_data['booking_data']['to_location'],
                'ship_id'  => $trip_data['trip1']['ship_id'] ?? NULL,
                'ship_name'  => $trip_data['trip1']['ship_name'],
                'trip_type'  => 'Trip 1',
                'user_id'  => $user_id,
            ]);
        }


        if (isset($trip_data['trip2'])) {
            $trip2_booking_id = DB::table('booking')->insertGetId([
                'schedule_id' => $trip_data['trip2']['schedule_id'],
                'type' => $request->type,
                'order_id' => $orderId,
                'c_name' => $request->c_name,
                'c_email' => $request->c_email,
                'c_mobile' => $request->c_mobile,
                'c_contact' => $request->c_contact,
                'payment_status' => 'pending',
                'amount'         => Session::get('total_trip2_amount'),
                'no_of_passenger' => $trip_data['booking_data']['no_of_passenger'],
                'date_of_jurney'  => $trip_data['booking_data']['round1_date'],
                //'return_date'  => $request->return_date,
                'trip_id'  => $trip_data['trip2']['trip_id'],
                'route_id'  => $trip_data['trip2']['route_id'], // for green ocean
                'vessel_id'  => $trip_data['trip2']['vesselID'] ?? NULL,
                'departure_time'  => $trip_data['trip2']['departure_time'],
                'arrival_time'  => $trip_data['trip2']['arrival_time'],
                'nautika_class'  =>  $trip_data['trip2']['ship_name'] == 'Nautika' ? $trip_data['trip2']['class_id'] : NULL,
                'makruzz_class'  => $trip_data['trip2']['ship_name'] == 'Makruzz' ? $trip_data['trip2']['class_id'] : NULL,
                'green_ocean_class'  => $trip_data['booking_data']['schedule'][1] == 'Admin' ? $trip_data['trip2']['class_id'] : NULL,
                'ferry_class'  => $trip_data['trip2']['class_title'],
                'from_location'  => $trip_data['booking_data']['round1_from_location'],
                'to_location'  => $trip_data['booking_data']['round1_to_location'],
                'ship_id'  => $trip_data['trip2']['ship_id'] ?? NULL,
                'ship_name'  => $trip_data['trip2']['ship_name'],
                'trip_type'  => 'Trip 2',
                'user_id'  => $user_id,
            ]);
        }

        if (isset($trip_data['trip3'])) {
            $trip3_booking_id = DB::table('booking')->insertGetId([
                'schedule_id' => $trip_data['trip3']['schedule_id'],
                'type' => $request->type,
                'order_id' => $orderId,
                'c_name' => $request->c_name,
                'c_email' => $request->c_email,
                'c_mobile' => $request->c_mobile,
                'c_contact' => $request->c_contact,
                'payment_status' => 'pending',
                'amount'         => Session::get('total_trip3_amount'),
                'no_of_passenger' => $trip_data['booking_data']['no_of_passenger'],
                'date_of_jurney'  => $trip_data['booking_data']['round2_date'],
                //'return_date'  => $request->return_date,
                'trip_id'  => $trip_data['trip3']['trip_id'],
                'route_id'  => $trip_data['trip3']['route_id'], // for green ocean
                'vessel_id'  => $trip_data['trip3']['vesselID'] ?? NULL,
                'departure_time'  => $trip_data['trip3']['departure_time'],
                'arrival_time'  => $trip_data['trip3']['arrival_time'],
                'nautika_class'  =>  $trip_data['trip3']['ship_name'] == 'Nautika' ? $trip_data['trip3']['class_id'] : NULL,
                'makruzz_class'  => $trip_data['trip3']['ship_name'] == 'Makruzz' ? $trip_data['trip3']['class_id'] : NULL,
                'green_ocean_class'  => $trip_data['booking_data']['schedule'][1] == 'Admin' ? $trip_data['trip3']['class_id'] : NULL,
                'ferry_class'  => $trip_data['trip3']['class_title'],
                'from_location'  => $trip_data['booking_data']['round2_from_location'],
                'to_location'  => $trip_data['booking_data']['round2_to_location'],
                'ship_id'  => $trip_data['trip3']['ship_id'] ?? NULL,
                'ship_name'  => $trip_data['trip3']['ship_name'],
                'trip_type'  => 'Trip 3',
                'user_id'  => $user_id,
            ]);
        }

        if (!empty($trip1_booking_id)) {
            $passengerTitles = $request->input('passenger_title');
            $passengerNames = $request->input('passenger_name');
            $passengerDobs = $request->input('passenger_dob');
            $passengerGenders = $request->input('passenger_gender');
            $passengerNationalities = $request->input('passenger_nationality');
            $country_name = $request->input('country_name');
            $passport_id = $request->input('passport_id');
            $expiry_date = $request->input('expiry_date');

            if (
                is_array($passengerTitles) && is_array($passengerNames) && is_array($passengerDobs) && is_array($passengerGenders) && is_array($passengerNationalities) &&
                count($passengerTitles) === count($passengerNames) && count($passengerNames) === count($passengerDobs) && count($passengerDobs) === count($passengerGenders) && count($passengerGenders) === count($passengerNationalities)
            ) {

                // // Agent wallet balance check for Green Ocean
                // $hash_sequence = "today_date|public_key";
                // $godata['today_date'] = date("d-m-Y"); // Today Date as DD-MM-YYYY
                // $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
                // $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string
                // $json_go = json_encode($godata);

                // $wallet_result = $this->greenOceanApiCall('wallet-balance', $godata);
                // $wallet_data = json_decode($wallet_result);
                // if ($wallet_data['status'] == 'success') {
                //     # code...
                // }

                foreach ($passengerTitles as $index => $title) {
                    if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip1']['ship_name'] != 'Nautika') {
                        $paxFare = 0;
                    } else if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip1']['ship_name'] == 'Nautika') {
                        $paxFare = $trip_data['trip1']['infantFare'];
                    } else {
                        $paxFare = $trip_data['trip1']['fare'];
                    }


                    $ferryPassengerData = [
                        'booking_id' => $trip1_booking_id,
                        'title' => $passengerTitles[$index],
                        'full_name' => $passengerNames[$index],
                        'dob' => $passengerDobs[$index],
                        'gender' => $passengerGenders[$index],
                        'resident' => $passengerNationalities[$index],
                        'country' => $country_name[$index] ?? 'India',
                        'passport_id' => $passport_id[$index],
                        'expiry_date' => $expiry_date[$index],
                        'trip_type' => $trip_type,
                        'fare' => $paxFare,
                        'psf' => $trip_data['trip1']['psf'],
                    ];

                    DB::table('booking_passenger_details')->insert($ferryPassengerData);
                }

                $api_key  = env("RAZOR_KEY_ID");
                $api_secret = env("RAZOR_KEY_SECRET");
                // $total_amount = $request->amount;
                $mobile  = $request->c_mobile;
                $name = $request->c_name;
                $email = $request->c_email;
                $total_amount = Session::get('total_amount');

                $api = new Api($api_key, $api_secret);

                $order = $api->order->create(array('receipt' => '123', 'amount' => $total_amount * 100, 'currency' => 'INR')); // commented by NS for test purpose
                // $order = $api->order->create(array('receipt' => '123', 'amount' => 1 * 100, 'currency' => 'INR')); // price set to 1 for test only
                $order_id = $order['id'];

                Session::put('order_id', $order_id);

                Session::put('user_phone', $mobile);
                Session::put('user_email', $email);
                Session::put('user_name', $name);
                Session::put('booking_id', $trip1_booking_id);
                Session::put('trip_type', $trip_type);

                if (!empty($trip2_booking_id)) {
                    foreach ($passengerTitles as $index => $title) {
                        // $fullName = $title . ' ' . $passengerNames[$index];
                        if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip2']['ship_name'] != 'Nautika') {
                            $paxFare = 0;
                        } else if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip2']['ship_name'] == 'Nautika') {
                            $paxFare = $trip_data['trip2']['infantFare'];
                        } else {
                            $paxFare = $trip_data['trip2']['fare'];
                        }

                        $ferryPassengerData2 = [
                            'booking_id' => $trip2_booking_id,
                            'title' => $passengerTitles[$index],
                            'full_name' => $passengerNames[$index],
                            'dob' => $passengerDobs[$index],
                            'gender' => $passengerGenders[$index],
                            'resident' => $passengerNationalities[$index],
                            'country' => $country_name[$index] ?? 'India',
                            'passport_id' => $passport_id[$index],
                            'expiry_date' => $expiry_date[$index],
                            'trip_type' => $trip_type,
                            'fare' => $paxFare,
                            'psf' => $trip_data['trip2']['psf'],
                        ];
                        DB::table('booking_passenger_details')->insert($ferryPassengerData2);
                    }

                    Session::put('trip2_booking_id', $trip2_booking_id);
                }

                if (!empty($trip3_booking_id)) {
                    foreach ($passengerTitles as $index => $title) {
                        // $fullName = $title . ' ' . $passengerNames[$index];
                        if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip3']['ship_name'] != 'Nautika') {
                            $paxFare = 0;
                        } else if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip3']['ship_name'] == 'Nautika') {
                            $paxFare = $trip_data['trip3']['infantFare'];
                        } else {
                            $paxFare = $trip_data['trip3']['fare'];
                        }
                        $ferryPassengerData3 = [
                            'booking_id' => $trip3_booking_id,
                            'title' => $passengerTitles[$index],
                            'full_name' => $passengerNames[$index],
                            'dob' => $passengerDobs[$index],
                            'gender' => $passengerGenders[$index],
                            'resident' => $passengerNationalities[$index],
                            'country' => $country_name[$index] ?? 'India',
                            'passport_id' => $passport_id[$index],
                            'expiry_date' => $expiry_date[$index],
                            'trip_type' => $trip_type,
                            'fare' => $paxFare,
                            'psf' => $trip_data['trip3']['psf'],
                        ];
                        DB::table('booking_passenger_details')->insert($ferryPassengerData3);
                    }

                    Session::put('trip3_booking_id', $trip3_booking_id);
                }
                return view('razorpay.payment', compact('order_id',));
            }
        }
    }


    public function payment_response(Request $request, $order_id)
    {

        if (Auth::id()) {
            $userId = Auth::id();
        } else {
            $userId = NULL;
        }

        // dd($request);

        $success = true;
        $error = "payment_failed";

        if (empty($_POST['razorpay_payment_id']) === false) {
            $api_key  = env("RAZOR_KEY_ID");
            $api_secret = env("RAZOR_KEY_SECRET");
            $api = new Api($api_key, $api_secret);
            try {
                $attributes = array(
                    // 'razorpay_order_id' => Session::get('order_id'),
                    'razorpay_order_id' => $order_id,
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
                $api->utility->verifyPaymentSignature($attributes);

                $payment = (array) $api->payment->fetch($_POST['razorpay_payment_id']);
                foreach ($payment as $key => $value) {
                    $payment = $value;
                    break;
                }

                if (!empty($payment['notes'])) {
                    $notes_value = (array) $payment['notes'];
                    foreach ($notes_value as $key => $value) {
                        $address = $value['address'];
                        //$merchant_order_id = $value['merchant_order_id'];
                    }
                }
            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay_Error : ' . $e->getMessage();
            }
        }

        if ($success === true) {

            $tran_data = array(
                'user_id' => Session::get('user_id'),
                'order_id' => !empty($payment['order_id']) ? $request->razorpay_order_id : NULL,
                'payment_id' => !empty($payment['id']) ? $payment['id'] : NULL,
                'amount' => !empty($payment['amount']) ? $payment['amount'] / 100 : NULL,
                'currency' => !empty($payment['currency']) ? $payment['currency'] : NULL,
                'status' => !empty($payment['status']) ? $payment['status'] : NULL,
                'invoice_id' => !empty($payment['invoice_id']) ? $payment['invoice_id'] : NULL,
                'international' => !empty($payment['international']) ? $payment['international'] : NULL,
                'method' => !empty($payment['method']) ? $payment['method'] : NULL,
                'amount_refunded' => !empty($payment['amount_refunded']) ? $payment['amount_refunded'] : NULL,
                'refund_status' => !empty($payment['refund_status']) ? $payment['refund_status'] : NULL,
                'captured' => !empty($payment['captured']) ? $payment['captured'] : NULL,
                'description' => !empty($payment['description']) ? $payment['description'] : NULL,
                'card_id' => !empty($payment['card_id']) ? $payment['card_id'] : NULL,
                'bank' => !empty($payment['bank']) ? $payment['bank'] : NULL,
                'wallet' => !empty($payment['wallet']) ? $payment['wallet'] : NULL,
                'vpa' => !empty($payment['vpa']) ? $payment['vpa'] : NULL,
                'email' => !empty($payment['email']) ? $payment['email'] : NULL,
                'contact' => !empty($payment['contact']) ? $payment['contact'] : NULL,

                'address' => !empty($address) ? $address : NULL,
                'fee' => !empty($payment['fee']) ? $payment['fee'] : NULL,
                'tax' => !empty($payment['tax']) ? $payment['tax'] : NULL,
                'error_code' => !empty($payment['error_code']) ? $payment['error_code'] : NULL,
                'error_description' => !empty($payment['error_description']) ? $payment['error_description'] : NULL,
                'error_source' => !empty($payment['error_source']) ? $payment['error_source'] : NULL,
                'error_step' => !empty($payment['error_step']) ? $payment['error_step'] : NULL,
                'error_reason' => !empty($payment['error_reason']) ? $payment['error_reason'] : NULL,
                //'bank_transaction_id' => !empty($bank_transaction_id)? $bank_transaction_id : NULL,
                'created_at' => !empty($payment['created_at']) ? date('Y-m-d H:i:s', strtotime($payment['created_at'])) : NULL
            );

            $success = RazorpayPaymentDetail::create($tran_data);

            if ($success) {
                $booking_id = Session::get('booking_id');
                $inserted_trip2_booking_id = Session::get('trip2_booking_id');
                $inserted_trip3_booking_id = Session::get('trip3_booking_id');

                DB::table('booking')->where('id', $booking_id)->update(['payment_status' => 'success']);
                DB::table('booking')->where('id', $inserted_trip2_booking_id)->update(['payment_status' => 'success']);
                DB::table('booking')->where('id', $inserted_trip3_booking_id)->update(['payment_status' => 'success']);
                $data = [
                    'order_id' => $order_id,
                    'user_id' => $userId,
                    'payment_details' => $tran_data
                ];

                //**************** for nautika booking call api ******************************

                $trip_data = Session::get('trip_data');

                // $booking_id= Session::get('booking_id');

                if (Session::get('trip2_booking_id')) {
                    $trip2_booking_id = Session::get('trip2_booking_id');
                }

                if (Session::get('trip3_booking_id')) {
                    $trip3_booking_id = Session::get('trip3_booking_id');
                }

                $trip_type = Session::get('trip_type');
                $order_id = Session::get('order_id');

                $results = [];
                $results2 = [];

                // *********** for single booking **************
                $results = DB::table('booking')->select('*')->where('id', $booking_id)->first();

                $passenger_result = DB::table('booking_passenger_details')->select('*')->where('booking_id', $booking_id)->get();

                // ************************************ NAUTIKA **************************************************


                if (!empty($results->ship_name) && $results->ship_name == 'Nautika') {
                    $departure_time = $results->departure_time;
                    $booking_ts = Carbon::createFromFormat('H:i:s', $departure_time)->timestamp;

                    list($adults, $infants) = $passenger_result->partition(function ($passenger) {
                        return $passenger->title !== 'INFANT';
                    });


                    // $pax = $adults->map(function($passenger) use ($trip_data) {
                    $bClassSeats = [];
                    $pClassSeats = [];

                    $seatss = json_decode($trip_data['trip1']['tripSeatNo']);

                    if ($trip_data['trip1']['class_id'] === 'pClass') {
                        $pClassSeats = $seatss;
                    } else if ($trip_data['trip1']['class_id'] === 'bClass') {
                        $bClassSeats = $seatss;
                    }

                    $pax = $adults->map(function ($passenger, $index) use ($trip_data, $bClassSeats, $pClassSeats) {
                        $seat_str = ($trip_data['trip1']['tripSeatNo']);
                        $seats_array = json_decode($seat_str);

                        $tier = '';
                        if ($trip_data['trip1']['class_id'] === 'pClass') {
                            $tier = 'P';
                        } else if ($trip_data['trip1']['class_id'] === 'bClass') {
                            $tier = 'B';
                        }

                        return array(
                            'id' => $passenger->id,
                            'name' => $passenger->title . ' ' . $passenger->full_name,
                            'age' => $passenger->dob,
                            'gender' => $passenger->gender,
                            'nationality' => $passenger->resident,
                            'passport' => $passenger->passport_id,
                            'tier' => $tier,
                            'seat' => $seats_array[$index], // Seat assignment using the index
                            'isCancelled' => 0,
                        );
                    })->toArray();

                    // Map infants
                    $infantPax = $infants->map(function ($passenger) {
                        return array(
                            'id' => $passenger->id,
                            'name' => $passenger->title . ' ' . $passenger->full_name,
                            'age' => $passenger->dob,
                            'gender' => $passenger->gender,
                            'nationality' => $passenger->resident,
                            'passport' => $passenger->passport_id,
                            'tier' => '',
                            'seat' => '',
                            'isCancelled' => 0,
                        );
                    })->toArray();

                    // $bClassSeats = $pClassSeats = [];
                    // foreach ($variable as $key => $value) {
                    //     if($value['class'] == 'pclass'){
                    //         $pClassSeats[] = $value['seat'];
                    //     }
                    //     if($value['class'] == 'bclass'){
                    //         $bClassSeats[] = $value['seat'];
                    //     }
                    // }

                    $from_location_title = '';
                    $to_location_title = '';

                    if ($trip_data['booking_data']['form_location'] == 1) {
                        $from_location_title = 'Port Blair';
                    } elseif ($trip_data['booking_data']['form_location'] == 2) {
                        $from_location_title = 'Swaraj Dweep';
                    } elseif ($trip_data['booking_data']['form_location'] == 3) {
                        $from_location_title = 'Shaheed Dweep';
                    }

                    if ($trip_data['booking_data']['to_location'] == 1) {
                        $to_location_title = 'Port Blair';
                    } elseif ($trip_data['booking_data']['to_location'] == 2) {
                        $to_location_title = 'Swaraj Dweep';
                    } elseif ($trip_data['booking_data']['to_location'] == 3) {
                        $to_location_title = 'Shaheed Dweep';
                    }


                    // Construct bookingData array
                    $bookingData = array(
                        array(
                            'bookingTS' => $booking_ts,
                            'id' => $results->schedule_id,
                            'tripId' => $results->trip_id,
                            'vesselID' => $results->vessel_id,
                            'from' => $from_location_title,
                            'to' =>  $to_location_title,
                            'paxDetail' => array(
                                'email' => $results->c_email,
                                'phone' => $results->c_mobile,
                                'gstin' => '',
                                'pax' => $pax,
                                'infantPax' => $infantPax,
                                'bClassSeats' => $bClassSeats,
                                'pClassSeats' => $pClassSeats,
                            ),
                            'userData' => array(
                                'apiUser' => array(
                                    'userName' => env('NAUTIKA_API_USERNAME'),
                                    'agency' => '',
                                    'token' => env('NAUTIKA_TOKEN'),
                                    'walletBalance' => 5000,
                                ),
                            ),
                            'paymentData' => array(
                                'gstin' => '',
                            ),
                        )
                    );


                    $finalData = array(
                        'bookingData' => $bookingData,
                        'userName' => env('NAUTIKA_API_USERNAME'),
                        'token' => env('NAUTIKA_TOKEN'),
                    );

                    // print_r($finalData);die;

                    $nautika_booked_details = $this->nautikaApiCall('bookSeats',  $finalData);
                    // print_r($nautika_booked_details);die;
                    foreach ($nautika_booked_details as $nautika) {
                        if (!empty($nautika->pnr)) {
                            $booking_response = array(
                                'booking_id' => $booking_id,
                                'pnr_id' => $nautika->pnr,
                                'booking_status' => 'Success',
                                'razorpay_payment_id' => $payment['id'],
                                'seat_status' => $nautika->seatStatus,
                                'booking_vendor' => 'Nautika',
                            );
                        } else {
                            $booking_response = array(
                                'booking_id' => $booking_id,
                                'pnr_id' => NULL,
                                'booking_status' => 'Failed',
                                'razorpay_payment_id' => $payment['id'],
                                'seat_status' => 0,
                                'booking_vendor' => 'Nautika',
                            );
                        }

                        DB::table('pnr_status')->insert($booking_response);
                    }

                    //********** *Makruzz booking ******
                } elseif (!empty($results->ship_name) && $results->ship_name == 'Makruzz') {
                    $passengers = [];
                    foreach ($passenger_result as $key => $passenger) {
                        //$dob = Carbon::parse($passenger->dob);
                        $name = $passenger->full_name;
                        $title = $passenger->title;
                        // $name = Str::after($name, ' ');

                        $passengers[++$key] = array(
                            'title' => $title,
                            'name' => $name,
                            'age' =>  $passenger->dob,
                            'sex' => $passenger->gender,
                            'nationality' => $passenger->resident,
                            "fcountry" => $passenger->country,
                            "fpassport" => $passenger->passport_id,
                            "fexpdate" => $passenger->expiry_date,
                        );
                    }

                    $data = array(
                        'passenger' => $passengers,
                        'c_name' => $results->c_name,
                        'c_mobile' => $results->c_mobile,
                        'c_email' => $results->c_email,
                        'p_contact' => $results->c_mobile,
                        'c_remark' => 'test',
                        'no_of_passenger' => count($passengers),
                        'schedule_id' => $results->schedule_id,
                        'travel_date' => $results->date_of_jurney,
                        'class_id' => $results->makruzz_class,
                        'fare' => $results->amount,
                        'tc_check' => true,
                    );

                    $data_json = array('data' => $data);

                    $makruzz_booked_details = $this->makApiCall('savePassengers', $data_json);
                    // var_dump($makruzz_booked_details);die;
                    $makruzz_booking_id = $makruzz_booked_details->data->booking_id;

                    $data = array(
                        'booking_id' => $booking_id,
                    );
                    $data10 = array('data' => array('booking_id' => $makruzz_booking_id));

                    $response = $this->makApiCall('confirm_booking', $data10);

                    if (!empty($response->data->pnr)) {
                        $booking_response = array(
                            'booking_id' => $booking_id,
                            'pnr_id' => $response->data->pnr,
                            'booking_status' => 'Success',
                            'razorpay_payment_id' => $payment['id'],
                            'makruzz_booking_id' => $makruzz_booking_id,
                            'seat_status' => 1,
                            'booking_vendor' => 'Makruzz',
                        );

                        $this->sendMailMakruzz($booking_id, $response->data->pnr);
                    } else {
                        $booking_response = array(
                            'booking_id' => $booking_id,
                            'pnr_id' => NULL,
                            'booking_status' => 'Failed',
                            'razorpay_payment_id' => $payment['id'],
                            'makruzz_booking_id' => NULL,
                            'seat_status' => 0,
                            'booking_vendor' => 'Makruzz',
                        );
                    }

                    DB::table('pnr_status')->insert($booking_response);

                    // green ocean single booking
                }
                // ************************************ Green Ocean **************************************************
                elseif (!empty($results->ship_name) && str_contains($results->ship_name, 'Green Ocean')) {

                    $hash_sequence = "ship_id|from_id|dest_to|route_id|class_id|number_of_adults|number_of_infants|travel_date|seat_id|public_key";
                    $godata['ship_id'] = $trip_data['trip1']['ship_id']; // Ship ID from 1-search-ferry.php response selected seat class
                    $godata['from_id'] = $results->from_location; // 1: Port Blair, 2 : Havelock, 3: Neil
                    $godata['dest_to'] = $results->to_location; // 1: Port Blair, 2 : Havelock, 3: Neil
                    $godata['route_id'] = $trip_data['trip1']['route_id'];  // Route ID from 1-search-ferry.php response selected seat class
                    $godata['class_id'] = $trip_data['trip1']['class_id'];  // Class ID from 1-search-ferry.php response selected seat class

                    $godata['number_of_adults'] = $trip_data['booking_data']['no_of_passenger']; // No of Adults
                    $godata['number_of_infants'] = $trip_data['booking_data']['no_of_infant']; // No of Infants


                    $p_prefix = $p_name = $p_age = $p_gender = $p_nationality = $p_passport_numb = $p_passport_expairy = $p_country = [];
                    $i_prefix = $i_name = $i_age = $i_gender = [];
                    foreach ($passenger_result as $key => $passenger) {
                        //$dob = Carbon::parse($passenger->dob);
                        $name = $passenger->full_name;
                        $title = $passenger->title;
                        // $name = Str::after($name, ' ');

                        if ($passenger->title == 'INFANT') {
                            $i_prefix[] = $passenger->title;
                            $i_name[] = $passenger->full_name;
                            $i_age[] = $passenger->dob;
                            $i_gender[] = $passenger->gender;
                        } else {
                            $p_prefix[] = $passenger->title;
                            $p_name[] = $passenger->full_name;
                            $p_age[] = $passenger->dob;
                            $p_gender[] = $passenger->gender;
                            $p_nationality[] = $passenger->resident;
                            $p_passport_numb[] = $passenger->passport_id;
                            $p_passport_expairy[] = $passenger->expiry_date;
                            $p_country[] = $passenger->country;
                        }
                    }

                    // Adult Passenger details
                    $godata['passenger_prefix'] = $p_prefix; //["Mr","Mrs"];  // only Allowed Mr/Dr/Master/Mrs/Ms/Miss/
                    $godata['passenger_name'] = $p_name;
                    $godata['passenger_age'] = $p_age;
                    $godata['gender'] = $p_gender; // only Allowed Male/Female
                    $godata['nationality'] = $p_nationality; // Only Allowed Indian/Foreigner

                    // Passport details are passed only for adults, not asked for infants.
                    $godata['passport_numb'] = $p_passport_numb;  // pass passport number
                    $godata['passport_expairy'] = $p_passport_expairy; // pass passport expiry date as DD-MM-YYYY format
                    $godata['country'] = $p_country; // pass passport country name as string

                    $godata['infant_prefix'] = $i_prefix;
                    $godata['infant_name'] = $i_name;
                    $godata['infant_age'] = $i_age;
                    $godata['infant_gender'] = $i_gender;

                    $godata['travel_date'] = date('d-m-Y', strtotime($results->date_of_jurney));
                    $godata['seat_id'] = (array) json_decode($trip_data['trip1']['trip_seat_no']);


                    $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
                    $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string

                    $booking_json = json_encode($godata);

                    $booking_api_res = $this->greenOceanApiCall('book-ticket', $godata);


                    if (!empty($booking_api_res->pnr)) {
                        $booking_response_green = array(
                            'booking_id' => $booking_id,
                            'pnr_id' => $booking_api_res->pnr,
                            'razorpay_payment_id' => $payment['id'],
                            'makruzz_booking_id' => NULL,
                            'booking_status' => 'Success',
                            'seat_status' => 1,
                            'booking_vendor' => $results->ship_name,
                        );

                        $this->sendMailGreenOcean($booking_api_res->pnr);
                    } else {
                        $booking_response_green = array(
                            'booking_id' => $booking_id,
                            'pnr_id' => NULL,
                            'razorpay_payment_id' => $payment['id'],
                            'makruzz_booking_id' => NULL,
                            'booking_status' => 'Failed',
                            'seat_status' => 0,
                            'booking_vendor' => $results->ship_name,
                        );
                    }
                    DB::table('pnr_status')->insert($booking_response_green);
                } elseif (!empty($results->ship_name) && ($results->ship_name == 'ITT Majestic')) {

                    $booking_response = array(
                        'booking_id' => $booking_id,
                        'pnr_id' => NULL,
                        'razorpay_payment_id' => $payment['id'],
                        'makruzz_booking_id' => NULL,
                        'booking_status' => 'Success',
                        'seat_status' => 0,
                        'booking_vendor' => 'Green Ocean',
                    );

                    DB::table('pnr_status')->insert($booking_response);

                    // green ocean single booking
                } elseif ($results->type == 'boat') {
                    $booking_response = array(
                        'booking_id' => $booking_id,
                        'pnr_id' => NULL,
                        'booking_status' => 'Success',
                        'razorpay_payment_id' => $payment['id'],
                        'makruzz_booking_id' => NULL,
                        'seat_status' => 0,
                        'booking_vendor' => 'Boat',
                    );

                    DB::table('pnr_status')->insert($booking_response);
                }

                // ************************** when trip 2 booking ************************
                if (!empty($trip2_booking_id)) {

                    $results2 = DB::table('booking')->select('*')->where('id', $trip2_booking_id)->first();
                    $passenger_result = DB::table('booking_passenger_details')->select('*')->where('booking_id', $trip2_booking_id)->get();
                    $departure_time = $results2->departure_time;
                    $booking_ts = Carbon::createFromFormat('H:i:s', $departure_time)->timestamp;

                    if ($results2->ship_name == 'Nautika') {
                        list($return_adults, $return_infants) = $passenger_result->partition(function ($passenger) {
                            return $passenger->title !== 'INFANT';
                        });

                        $bClassSeats = [];
                        $pClassSeats = [];

                        $seatss = json_decode($trip_data['trip2']['tripSeatNo']);

                        if ($trip_data['trip2']['class_id'] === 'pClass') {
                            $pClassSeats = $seatss;
                        } else if ($trip_data['trip2']['class_id'] === 'bClass') {
                            $bClassSeats = $seatss;
                        }

                        $return_pax = $return_adults->map(function ($passenger, $index) use ($trip_data, $bClassSeats, $pClassSeats) {
                            $tier = '';
                            if ($trip_data['trip2']['class_id'] === 'pClass') {
                                $tier = 'P';
                            } else if ($trip_data['trip2']['class_id'] === 'bClass') {
                                $tier = 'B';
                            }
                            $seat_str = ($trip_data['trip2']['tripSeatNo']);
                            $seats_array = json_decode($seat_str);

                            return array(
                                'id' => $passenger->id,
                                'name' => $passenger->title . ' ' . $passenger->full_name,
                                'age' => $passenger->dob,
                                'gender' => $passenger->gender,
                                'nationality' => $passenger->resident,
                                'passport' => $passenger->passport_id ?? NULL,
                                'tier' => $tier,
                                'seat' =>  $seats_array[$index],
                                'isCancelled' => 0,
                            );
                        })->toArray();

                        // Map infants
                        $return_infantPax = $return_infants->map(function ($passenger) {
                            return array(
                                'id' => $passenger->id,
                                'name' => $passenger->title . ' ' . $passenger->full_name,
                                'age' => $passenger->dob,
                                'gender' => $passenger->gender,
                                'nationality' => $passenger->resident,
                                'passport' => '',
                                'tier' => '',
                                'seat' => '',
                                'isCancelled' => 0,
                            );
                        })->toArray();


                        $round1_from_location_title = '';
                        $round1_to_location_title = '';

                        if ($trip_data['booking_data']['round1_from_location'] == 1) {
                            $round1_from_location_title = 'Port Blair';
                        } elseif ($trip_data['booking_data']['round1_from_location'] == 2) {
                            $round1_from_location_title = 'Swaraj Dweep';
                        } elseif ($trip_data['booking_data']['round1_from_location'] == 3) {
                            $round1_from_location_title = 'Shaheed Dweep';
                        }

                        if ($trip_data['booking_data']['round1_to_location'] == 1) {
                            $round1_to_location_title = 'Port Blair';
                        } elseif ($trip_data['booking_data']['round1_to_location'] == 2) {
                            $round1_to_location_title = 'Swaraj Dweep';
                        } elseif ($trip_data['booking_data']['round1_to_location'] == 3) {
                            $round1_to_location_title = 'Shaheed Dweep';
                        }


                        $bookingData2 = array(
                            array(
                                'bookingTS' => $booking_ts,
                                'id' => $results2->schedule_id,
                                'tripId' => $results2->trip_id,
                                'vesselID' => $results2->vessel_id,
                                'from' =>  $round1_from_location_title,
                                'to' => $round1_to_location_title,
                                'paxDetail' => array(
                                    'email' => $results2->c_email,
                                    'phone' => $results2->c_mobile,
                                    'gstin' => '',
                                    'pax' => $return_pax,
                                    'infantPax' => $return_infantPax, // Add similar logic for infants if required
                                    'bClassSeats' => $bClassSeats,
                                    'pClassSeats' => $pClassSeats,
                                ),
                                'userData' => array(
                                    'apiUser' => array(
                                        'userName' => env('NAUTIKA_API_USERNAME'),
                                        'agency' => '',
                                        'token' => env('NAUTIKA_TOKEN'),
                                        'walletBalance' => 5000,
                                    ),
                                ),
                                'paymentData' => array(
                                    'gstin' => '',
                                ),
                            )
                        );

                        $finalData2 = array(
                            'bookingData' => $bookingData2,
                            'userName' => env('NAUTIKA_API_USERNAME'),
                            'token' => env('NAUTIKA_TOKEN'),

                        );

                        $nautika_booked_details2 = $this->nautikaApiCall('bookSeats',  $finalData2);

                        foreach ($nautika_booked_details2 as $nautika) {
                            if (!empty($nautika->pnr)) {
                                $booking_response2 = array(
                                    'booking_id' => $trip2_booking_id,
                                    'pnr_id' => $nautika->pnr,
                                    'booking_status' => 'Success',
                                    'razorpay_payment_id' => $payment['id'],
                                    'seat_status' => $nautika->seatStatus,
                                    'booking_vendor' => 'Nautika',
                                );
                            } else {
                                $booking_response2 = array(
                                    'booking_id' => $trip2_booking_id,
                                    'pnr_id' => Null,
                                    'booking_status' => 'Failed',
                                    'razorpay_payment_id' => $payment['id'],
                                    'seat_status' => 0,
                                    'booking_vendor' => 'Nautika',
                                );
                            }

                            DB::table('pnr_status')->insert($booking_response2);
                        }
                    } elseif (($results2->ship_name) == 'Makruzz') {

                        $passengers = [];
                        foreach ($passenger_result as $key => $passenger) {
                            $dob = Carbon::parse($passenger->dob);
                            $name = $passenger->full_name;
                            $title = $passenger->title;

                            $passengers[++$key] = array(
                                'title' => $title,
                                'name' => $name,
                                'age' =>  $passenger->dob,
                                'sex' => $passenger->gender,
                                'nationality' => $passenger->resident,
                                "fcountry" => $passenger->country,
                                "fpassport" => $passenger->passport_id,
                                "fexpdate" => $passenger->expiry_date,
                            );
                        }

                        $data2 = array(
                            'passenger' => $passengers,
                            'c_name' => $results2->c_name,
                            'c_mobile' => $results2->c_mobile,
                            'c_email' => $results2->c_email,
                            'p_contact' => $results2->c_mobile,
                            'c_remark' => 'test',
                            'no_of_passenger' => count($passengers),
                            'schedule_id' => $results2->schedule_id,
                            'travel_date' => $results2->date_of_jurney,
                            'class_id' => $results2->makruzz_class,
                            'fare' => $results2->amount,
                            'tc_check' => true,
                        );

                        $data_json = array('data' => $data2);
                        $makruzz_booked_details = $this->makApiCall('savePassengers', $data_json);

                        $mak_booking_id = $makruzz_booked_details->data->booking_id;

                        $data = array(
                            'booking_id' => $mak_booking_id,
                        );
                        $data10 = array('data' => array('booking_id' => $mak_booking_id));

                        $response = $this->makApiCall('confirm_booking', $data10);

                        if (!empty($response->data->pnr)) {
                            $booking_response2 = array(
                                'booking_id' => $trip2_booking_id,
                                'pnr_id' => $response->data->pnr,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => $mak_booking_id,
                                'booking_status' => 'Success',
                                'seat_status' => 1,
                                'booking_vendor' => 'Makruzz',
                            );

                            $this->sendMailMakruzz($trip2_booking_id, $response->data->pnr);
                        } else {
                            $booking_response2 = array(
                                'booking_id' => $trip2_booking_id,
                                'pnr_id' => NULL,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => NULL,
                                'booking_status' => 'Failed',
                                'seat_status' => 0,
                                'booking_vendor' => 'Makruzz',
                            );
                        }

                        DB::table('pnr_status')->insert($booking_response2);

                        // green ocean single booking

                    }
                    // ************************************ Green Ocean **************************************************
                    elseif (!empty($results2->ship_name) && str_contains($results2->ship_name, 'Green Ocean')) {

                        $hash_sequence = "ship_id|from_id|dest_to|route_id|class_id|number_of_adults|number_of_infants|travel_date|seat_id|public_key";
                        $godata['ship_id'] = $trip_data['trip2']['ship_id']; // Ship ID from 1-search-ferry.php response selected seat class
                        $godata['from_id'] = $results2->from_location; // 1: Port Blair, 2 : Havelock, 3: Neil
                        $godata['dest_to'] = $results2->to_location; // 1: Port Blair, 2 : Havelock, 3: Neil
                        $godata['route_id'] = $trip_data['trip2']['route_id'];  // Route ID from 1-search-ferry.php response selected seat class
                        $godata['class_id'] = $trip_data['trip2']['class_id'];  // Class ID from 1-search-ferry.php response selected seat class

                        $godata['number_of_adults'] = $trip_data['booking_data']['no_of_passenger']; // No of Adults
                        $godata['number_of_infants'] = $trip_data['booking_data']['no_of_infant']; // No of Infants


                        $p_prefix = $p_name = $p_age = $p_gender = $p_nationality = $p_passport_numb = $p_passport_expairy = $p_country = [];
                        $i_prefix = $i_name = $i_age = $i_gender = [];
                        foreach ($passenger_result as $key => $passenger) {
                            //$dob = Carbon::parse($passenger->dob);
                            $name = $passenger->full_name;
                            $title = $passenger->title;

                            if ($passenger->title == 'INFANT') {
                                $i_prefix[] = $passenger->title;
                                $i_name[] = $passenger->full_name;
                                $i_age[] = $passenger->dob;
                                $i_gender[] = $passenger->gender;
                            } else {
                                $p_prefix[] = $passenger->title;
                                $p_name[] = $passenger->full_name;
                                $p_age[] = $passenger->dob;
                                $p_gender[] = $passenger->gender;
                                $p_nationality[] = $passenger->resident;
                                $p_passport_numb[] = $passenger->passport_id;
                                $p_passport_expairy[] = $passenger->expiry_date;
                                $p_country[] = $passenger->country;
                            }
                        }

                        // Adult Passenger details
                        $godata['passenger_prefix'] = $p_prefix; //["Mr","Mrs"];  // only Allowed Mr/Dr/Master/Mrs/Ms/Miss/
                        $godata['passenger_name'] = $p_name;
                        $godata['passenger_age'] = $p_age;
                        $godata['gender'] = $p_gender; // only Allowed Male/Female
                        $godata['nationality'] = $p_nationality; // Only Allowed Indian/Foreigner

                        // Passport details are passed only for adults, not asked for infants.
                        $godata['passport_numb'] = $p_passport_numb;  // pass passport number
                        $godata['passport_expairy'] = $p_passport_expairy; // pass passport expiry date as DD-MM-YYYY format
                        $godata['country'] = $p_country; // pass passport country name as string

                        $godata['infant_prefix'] = $i_prefix;
                        $godata['infant_name'] = $i_name;
                        $godata['infant_age'] = $i_age;
                        $godata['infant_gender'] = $i_gender;

                        $godata['travel_date'] = date('d-m-Y', strtotime($results2->date_of_jurney));
                        $godata['seat_id'] = (array) json_decode($trip_data['trip2']['trip_seat_no']);


                        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
                        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string

                        // $booking_json = json_encode($godata);

                        $booking_api_res = $this->greenOceanApiCall('book-ticket', $godata);


                        if (!empty($booking_api_res->pnr)) {
                            $booking_response_green = array(
                                'booking_id' => $trip2_booking_id,
                                'pnr_id' => $booking_api_res->pnr,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => NULL,
                                'booking_status' => 'Success',
                                'seat_status' => 1,
                                'booking_vendor' => $results2->ship_name,
                            );

                            $this->sendMailGreenOcean($booking_api_res->pnr);

                        } else {
                            $booking_response_green = array(
                                'booking_id' => $trip2_booking_id,
                                'pnr_id' => NULL,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => NULL,
                                'booking_status' => 'Failed',
                                'seat_status' => 0,
                                'booking_vendor' => $results2->ship_name,
                            );
                        }
                        DB::table('pnr_status')->insert($booking_response_green);
                    } elseif ($results2->ship_name == 'ITT Majestic') {
                        $booking_response_itt = array(
                            'booking_id' => $trip2_booking_id,
                            'pnr_id' => NULL,
                            'razorpay_payment_id' => $payment['id'],
                            'makruzz_booking_id' => NULL,
                            'booking_status' => 'Success',
                            'seat_status' => 0,
                            'booking_vendor' => $results2->ship_name,
                        );

                        DB::table('pnr_status')->insert($booking_response_itt);
                    }
                }

                // ************************** when trip 3 booking ************************
                if (!empty($trip3_booking_id)) {

                    $results3 = DB::table('booking')->select('*')->where('id', $trip3_booking_id)->first();

                    $passenger_result = DB::table('booking_passenger_details')->select('*')->where('booking_id', $trip3_booking_id)->get();

                    $departure_time = $results3->departure_time;
                    $booking_ts = Carbon::createFromFormat('H:i:s', $departure_time)->timestamp;

                    if ($results3->ship_name == 'Nautika') {

                        list($return_adults, $return_infants) = $passenger_result->partition(function ($passenger) {
                            return $passenger->title !== 'INFANT';
                        });

                        $bClassSeats = [];
                        $pClassSeats = [];

                        $seatss = json_decode($trip_data['trip3']['tripSeatNo']);

                        if ($trip_data['trip3']['class_id'] === 'pClass') {
                            $pClassSeats = $seatss;
                        } else if ($trip_data['trip3']['class_id'] === 'bClass') {
                            $bClassSeats = $seatss;
                        }

                        $return_pax = $return_adults->map(function ($passenger, $index)  use ($trip_data, $bClassSeats, $pClassSeats) {
                            $tier = '';
                            $seat_str = ($trip_data['trip3']['tripSeatNo']);
                            $seats_array = json_decode($seat_str);

                            if ($trip_data['trip3']['class_id'] === 'pClass') {
                                $tier = 'P';
                            } else if ($trip_data['trip3']['class_id'] === 'bClass') {
                                $tier = 'B';
                            }

                            return array(
                                'id' => $passenger->id,
                                'name' => $passenger->title . ' ' . $passenger->full_name,
                                'age' => $passenger->dob,
                                'gender' => $passenger->gender,
                                'nationality' => $passenger->resident,
                                'passport' =>  $passenger->passport_id,
                                'tier' => $tier,
                                'seat' => $seats_array[$index],
                                'isCancelled' => 0,
                            );
                        })->toArray();


                        // Map infants
                        $return_infantPax = $return_infants->map(function ($passenger) {
                            return array(
                                'id' => $passenger->id,
                                'name' => $passenger->title . ' ' . $passenger->full_name,
                                'age' => $passenger->dob,
                                'gender' => $passenger->gender,
                                'nationality' => $passenger->resident,
                                'passport' => '',
                                'tier' => '',
                                'seat' => '',
                                'isCancelled' => 0,
                            );
                        })->toArray();


                        $round2_from_location_title = '';
                        $round2_to_location_title = '';

                        if ($trip_data['booking_data']['round2_from_location'] == 1) {
                            $round2_from_location_title = 'Port Blair';
                        } elseif ($trip_data['booking_data']['round2_from_location'] == 2) {
                            $round2_from_location_title = 'Swaraj Dweep';
                        } elseif ($trip_data['booking_data']['round2_from_location'] == 3) {
                            $round2_from_location_title = 'Shaheed Dweep';
                        }

                        if ($trip_data['booking_data']['round2_to_location'] == 1) {
                            $round2_to_location_title = 'Port Blair';
                        } elseif ($trip_data['booking_data']['round2_to_location'] == 2) {
                            $round2_to_location_title = 'Swaraj Dweep';
                        } elseif ($trip_data['booking_data']['round2_to_location'] == 3) {
                            $round2_to_location_title = 'Shaheed Dweep';
                        }

                        $bookingData2 = array(
                            array(
                                'bookingTS' => $booking_ts,
                                'id' => $results3->schedule_id,
                                'tripId' => $results3->trip_id,
                                'vesselID' => $results3->vessel_id,
                                'from' => $round2_from_location_title,
                                'to' => $round2_to_location_title,
                                'paxDetail' => array(
                                    'email' => $results3->c_email,
                                    'phone' => $results3->c_mobile,
                                    'gstin' => '',
                                    'pax' => $return_pax,
                                    'infantPax' => $return_infantPax, // Add similar logic for infants if required
                                    'bClassSeats' => $bClassSeats,
                                    'pClassSeats' => $pClassSeats,
                                ),
                                'userData' => array(
                                    'apiUser' => array(
                                        'userName' => env('NAUTIKA_API_USERNAME'),
                                        'agency' => '',
                                        'token' => env('NAUTIKA_API_USERNAME'),
                                        'walletBalance' => 5000,
                                    ),
                                ),
                                'paymentData' => array(
                                    'gstin' => '',
                                ),
                            )
                        );

                        $finalData2 = array(
                            'bookingData' => $bookingData2,
                            'userName' => env('NAUTIKA_API_USERNAME'),
                            'token' => env('NAUTIKA_TOKEN'),

                        );
                        $nautika_booked_details3 = $this->nautikaApiCall('bookSeats',  $finalData2);

                        foreach ($nautika_booked_details3 as $nautika) {
                            if (!empty($nautika->pnr)) {
                                $booking_response2 = array(
                                    'booking_id' => $trip3_booking_id,
                                    'pnr_id' => $nautika->pnr,
                                    'booking_status' => 'Success',
                                    'razorpay_payment_id' => $payment['id'],
                                    'seat_status' => $nautika->seatStatus,
                                    'booking_vendor' => 'Nautika',
                                );
                            } else {
                                $booking_response2 = array(
                                    'booking_id' => $trip3_booking_id,
                                    'pnr_id' => Null,
                                    'booking_status' => 'Failed',
                                    'razorpay_payment_id' => $payment['id'],
                                    'seat_status' => 0,
                                    'booking_vendor' => 'Nautika',
                                );
                            }

                            DB::table('pnr_status')->insert($booking_response2);
                        }
                    } elseif (($results3->ship_name) == 'Makruzz') {

                        $passengers = [];
                        foreach ($passenger_result as $key => $passenger) {

                            $dob = Carbon::parse($passenger->dob);
                            $name = $passenger->full_name;
                            $title = $passenger->title;

                            $passengers[++$key] = array(
                                'title' => $title,
                                'name' => $name,
                                'age' =>  $passenger->dob,
                                'sex' => $passenger->gender,
                                'nationality' => $passenger->resident,
                                "fcountry" => $passenger->country,
                                "fpassport" => $passenger->passport_id,
                                "fexpdate" => $passenger->expiry_date,
                            );
                        }

                        $data2 = array(
                            'passenger' => $passengers,
                            'c_name' => $results3->c_name,
                            'c_mobile' => $results3->c_mobile,
                            'c_email' => $results3->c_email,
                            'p_contact' => $results3->c_mobile,
                            'c_remark' => 'test',
                            'no_of_passenger' => count($passengers),
                            'schedule_id' => $results3->schedule_id,
                            'travel_date' => $results3->date_of_jurney,
                            'class_id' => $results3->makruzz_class,
                            'fare' => $results3->amount,
                            'tc_check' => true,
                        );

                        $data_json = array('data' => $data2);

                        $makruzz_booked_details = $this->makApiCall('savePassengers', $data_json);

                        // echo"<pre>";
                        // print_r($makruzz_booked_details);
                        // die();

                        $mak_booking_id = $makruzz_booked_details->data->booking_id;

                        $data = array(
                            'booking_id' => $mak_booking_id,
                        );
                        $data10 = array('data' => array('booking_id' => $mak_booking_id));

                        $response = $this->makApiCall('confirm_booking', $data10);

                        if (!empty($response->data->pnr)) {
                            $booking_response9 = array(
                                'booking_id' => $trip3_booking_id,
                                'pnr_id' => $response->data->pnr,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => $mak_booking_id,
                                'booking_status' => 'Success',
                                'seat_status' => 1,
                                'booking_vendor' => 'Makruzz',
                            );

                            $this->sendMailMakruzz($trip3_booking_id, $response->data->pnr);
                        } else {
                            $booking_response9 = array(
                                'booking_id' => $trip3_booking_id,
                                'pnr_id' => NULL,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => NULL,
                                'booking_status' => 'Failed',
                                'seat_status' => 0,
                                'booking_vendor' => 'Makruzz',
                            );
                        }

                        DB::table('pnr_status')->insert($booking_response9);

                        // green ocean single booking
                    }
                    // ************************************ Green Ocean **************************************************
                    elseif (!empty($results3->ship_name) && str_contains($results3->ship_name, 'Green Ocean')) {

                        $hash_sequence = "ship_id|from_id|dest_to|route_id|class_id|number_of_adults|number_of_infants|travel_date|seat_id|public_key";
                        $godata['ship_id'] = $trip_data['trip3']['ship_id']; // Ship ID from 1-search-ferry.php response selected seat class
                        $godata['from_id'] = $results3->from_location; // 1: Port Blair, 2 : Havelock, 3: Neil
                        $godata['dest_to'] = $results3->to_location; // 1: Port Blair, 2 : Havelock, 3: Neil
                        $godata['route_id'] = $trip_data['trip3']['route_id'];  // Route ID from 1-search-ferry.php response selected seat class
                        $godata['class_id'] = $trip_data['trip3']['class_id'];  // Class ID from 1-search-ferry.php response selected seat class

                        $godata['number_of_adults'] = $trip_data['booking_data']['no_of_passenger']; // No of Adults
                        $godata['number_of_infants'] = $trip_data['booking_data']['no_of_infant']; // No of Infants


                        $p_prefix = $p_name = $p_age = $p_gender = $p_nationality = $p_passport_numb = $p_passport_expairy = $p_country = [];
                        $i_prefix = $i_name = $i_age = $i_gender = [];
                        foreach ($passenger_result as $key => $passenger) {
                            //$dob = Carbon::parse($passenger->dob);
                            $name = $passenger->full_name;
                            $title = $passenger->title;

                            if ($passenger->title == 'INFANT') {
                                $i_prefix[] = $passenger->title;
                                $i_name[] = $passenger->full_name;
                                $i_age[] = $passenger->dob;
                                $i_gender[] = $passenger->gender;
                            } else {
                                $p_prefix[] = $passenger->title;
                                $p_name[] = $passenger->full_name;
                                $p_age[] = $passenger->dob;
                                $p_gender[] = $passenger->gender;
                                $p_nationality[] = $passenger->resident;
                                $p_passport_numb[] = $passenger->passport_id;
                                $p_passport_expairy[] = $passenger->expiry_date;
                                $p_country[] = $passenger->country;
                            }
                        }

                        // Adult Passenger details
                        $godata['passenger_prefix'] = $p_prefix; //["Mr","Mrs"];  // only Allowed Mr/Dr/Master/Mrs/Ms/Miss/
                        $godata['passenger_name'] = $p_name;
                        $godata['passenger_age'] = $p_age;
                        $godata['gender'] = $p_gender; // only Allowed Male/Female
                        $godata['nationality'] = $p_nationality; // Only Allowed Indian/Foreigner

                        // Passport details are passed only for adults, not asked for infants.
                        $godata['passport_numb'] = $p_passport_numb;  // pass passport number
                        $godata['passport_expairy'] = $p_passport_expairy; // pass passport expiry date as DD-MM-YYYY format
                        $godata['country'] = $p_country; // pass passport country name as string

                        $godata['infant_prefix'] = $i_prefix;
                        $godata['infant_name'] = $i_name;
                        $godata['infant_age'] = $i_age;
                        $godata['infant_gender'] = $i_gender;

                        $godata['travel_date'] = date('d-m-Y', strtotime($results3->date_of_jurney));
                        $godata['seat_id'] = (array) json_decode($trip_data['trip3']['trip_seat_no']);


                        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
                        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string

                        // $booking_json = json_encode($godata);

                        $booking_api_res = $this->greenOceanApiCall('book-ticket', $godata);


                        if (!empty($booking_api_res->pnr)) {
                            $booking_response_green = array(
                                'booking_id' => $trip3_booking_id,
                                'pnr_id' => $booking_api_res->pnr,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => NULL,
                                'booking_status' => 'Success',
                                'seat_status' => 1,
                                'booking_vendor' => $results3->ship_name,
                            );

                            $this->sendMailGreenOcean($booking_api_res->pnr);

                        } else {
                            $booking_response_green = array(
                                'booking_id' => $trip3_booking_id,
                                'pnr_id' => NULL,
                                'razorpay_payment_id' => $payment['id'],
                                'makruzz_booking_id' => NULL,
                                'booking_status' => 'Failed',
                                'seat_status' => 0,
                                'booking_vendor' => $results3->ship_name,
                            );
                        }
                        DB::table('pnr_status')->insert($booking_response_green);
                    } elseif ($results3->ship_name == 'ITT Majestic') {

                        $booking_response_itt = array(
                            'booking_id' => $trip3_booking_id,
                            'pnr_id' => NULL,
                            'razorpay_payment_id' => $payment['id'],
                            'makruzz_booking_id' => NULL,
                            'booking_status' => 'Success',
                            'seat_status' => 0,
                            'booking_vendor' => $results3->ship_name,
                        );

                        DB::table('pnr_status')->insert($booking_response_itt);
                    }
                }
            }

            // Session::forget('order_id');
            // Session::forget('amount');
            // Session::forget('user_name');
            // Session::forget('user_phone');
            // Session::forget('$trip1_booking_id');

            // Session::forget('ferryScheduleId');
            // Session::forget('nautika_class_id');
            // Session::forget('makruzz_class_id');
            // Session::forget('ferry_class_title');
            // Session::forget('tripId');
            // Session::forget('vesselID');
            // Session::forget('from_location');
            // Session::forget('to_location');
            // Session::forget('departure_date');
            // Session::forget('arrival_time');
            // Session::forget('to');
            // Session::forget('date');
            // Session::forget('passenger');
            // Session::forget('price');
            // Session::forget('ship_name');

            // Session::forget('single_trip');
            // Session::forget('booking_id');
            // Session::forget('trip2_booking_id');
            // Session::forget('trip3_booking_id');

            $user_email = Session::get('user_email');

            // var_dump($results);
            // echo "<br>";
            // echo "<br>";
            // var_dump($results2);

            // print_r($results->ship_name);
            // print_r($results2->ship_name);
            // die();

            $shipNameArray = array(
                'Green Ocean 1',
                'Green Ocean 2',
                'ITT Majestic',
                'Makruzz'
            );

            $bookingId1 = in_array($results->ship_name, $shipNameArray) ? $booking_id : NULL;
            $bookingId2 = (!empty($trip2_booking_id) && in_array($results2->ship_name, $shipNameArray)) ? $trip2_booking_id : NULL;
            $bookingId3 = (!empty($trip3_booking_id) && in_array($results3->ship_name, $shipNameArray)) ? $trip3_booking_id : NULL;

            // Send the email
            $greet = '';

            // $this->send_email($user_email, $bookingId1, $bookingId2, $bookingId3, $greet);

            $greet = 'Hello Admin';
            $user_email = 'andamanferrybookings@gmail.com';
            // $this->send_email($user_email, $booking_id, $trip2_booking_id, $trip3_booking_id, $greet);


            $data['order_id'] = $order_id;
            $data['booking_id'] = $booking_id ?? NULL;
            $data['trip2_booking_id'] = !empty($trip2_booking_id) ?? NULL;
            $data['trip3_booking_id'] = !empty($trip3_booking_id) ?? NULL;

            // print_r($data);die;

            return view('razorpay.success', $data);
        } else {
            echo 'Payment Failed';
            die;
        }
    }

    public function ticket_generate(request $request)
    {

        $booking_id = $request->booking_id;
        $trip2_booking_id = $request->trip2_booking_id;
        $trip3_booking_id = $request->trip3_booking_id;

        $data['single_booking'] = DB::table('booking')
            ->leftJoin('pnr_status as ps', 'ps.booking_id', '=', 'booking.id')
            ->where('booking.id', $booking_id)
            ->select('booking.*', 'ps.pnr_id')
            ->first();

        $data['trip2_booking_id'] = DB::table('booking')
            ->leftJoin('pnr_status as ps', 'ps.booking_id', '=', 'booking.id')
            ->where('booking.id', $trip2_booking_id)
            ->select('booking.*', 'ps.pnr_id')
            ->first();

        $data['trip3_booking_id'] = DB::table('booking')
            ->leftJoin('pnr_status as ps', 'ps.booking_id', '=', 'booking.id')
            ->where('booking.id', $trip3_booking_id)
            ->select('booking.*', 'ps.pnr_id')
            ->first();

        $data['bookingPassengerDetails'] = [];

        $data['bookings'] = DB::table('booking')
            ->where('id', $booking_id)
            ->get();

        //$data['bookingPassengerDetails'] = [];
        $bookingPassengerDetails = [];


        foreach ($data['bookings'] as $booking) {
            $passengers = DB::table('booking_passenger_details as b_p_d')
                ->where('b_p_d.booking_id', $booking->id)
                ->select('b_p_d.*')
                ->get();
            $bookingPassengerDetails[$booking->id] = $passengers;
        }

        $data['bookingPassengerDetails'] = $bookingPassengerDetails;

        return view('razorpay.ticket', $data);
    }

    public function send_email($user_email, $booking_id, $trip2_booking_id, $trip3_booking_id, $greet)
    {

        $details = [
            'booking_id' => $booking_id,
            'trip2_booking_id' => $trip2_booking_id,
            'trip3_booking_id' => $trip3_booking_id,
            'greet' => $greet,
        ];

        Mail::to($user_email)->send(new TestMail($details));

        return 'Email has been sent!';
    }

    // public function store_selected_seats(Request $request) {

    //     $tripNo = $request->tripNo;
    //     $seats = $request->seat_nos;

    //     Session::put('trip_no', $tripNo);
    //     Session::put('seats_' . $tripNo, $seats);

    //     return response()->json(['status' => 'success', 'message' => 'Selected seats stored successfully' ]);
    // }

    public function sendMailMakruzz($booking_id, $pnr)
    {

        $bookingDetails = DB::table('booking')->where('id', $booking_id)->first();

        $data = array(
            'bookingDetails' => (array) $bookingDetails,
            'pnr' => $pnr
        );

        $response = Http::withHeaders([
            'debug' => true, // Custom header to trigger debugging
            'Accept' => 'application/json'
        ])->timeout(20)->withoutVerifying()->post('nautika-api-call/email/sendmail.php', $data);
    }

    public function sendMailGreenOcean($pnr)
    {
        $godata['pnr'] = $pnr;
        // $godata['pnr'] = "TPMHE";
        $hash_sequence = "pnr|public_key";
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string

        // $booking_json = json_encode($godata);
        // dd($godata);

        // echo "PNR: $pnr<br>";

        $booking_api_res = $this->greenOceanApiCall('ticket-pnr', $godata);

        // dd($booking_api_res);
        if ($booking_api_res->status == 'success' && $booking_api_res->data->status == 'Okay') {

            // $pdf_filename = 'ticket_' . $pnr . '.pdf';

            // $pdf = Pdf::loadView('booking.bokingpage.green-ocean-ticket-template', ['ticket_data' => $booking_api_res->data]);
            // return $pdf->download($pdf_filename);

            $booking_data = DB::table('pnr_status as ps')
            ->select('b.*','ps.pnr_id', 'fl.name as form_location', 'tl.name as to_location')
            ->join('booking as b','b.id','=','ps.booking_id')
            ->join('locations as fl','fl.id','=','b.from_location')
            ->join('locations as tl','tl.id','=','b.to_location')
            ->where(['ps.pnr_id' => $pnr])
            ->first();

            if (empty($booking_data)) {
                return 'invalid_pnr';
            }

            $booking_data->payment_method = $booking_api_res->data->payment_method;

            $booking_data->passengers = DB::table('booking_passenger_details')->where(['booking_id' => $booking_data->id])->get();

            // $ticketTemplate = view('booking.bokingpage.green-ocean-mail-template', ['booking_data' => $booking_data])->render();
            $ticketTemplate = view('emails.green-ocean-mail-template', ['booking_data' => $booking_data])->render();

            // $user_email = "newtonsamaddar@gmail.com";
            $user_email = $booking_data->c_email;

            $data = array(
                'subject' => "Book my ferry booking mail",
                'mail_body' => $ticketTemplate,
                'email' => $user_email
            );

            $response = Http::withHeaders([
                'debug' => true, // Custom header to trigger debugging
                'Accept' => 'application/json'
            ])->timeout(20)->withoutVerifying()->post('nautika-api-call/email/sendmailgo.php', $data);

                // dd($response);

        } else {
            echo $booking_api_res->message;
            // dd($booking_api_res);
        }


        // $ticketTemplate = View::make('booking.bokingpage.green-ocean-ticket-template', compact('booking_api_res'))->render();

        // $data = array(
        //     'bookingDetails' => (array) $bookingDetails,
        //     'pnr' => $pnr
        // );

        // $response = Http::withHeaders([
        //     'debug' => true, // Custom header to trigger debugging
        //     'Accept' => 'application/json'
        // ])->timeout(20)->withoutVerifying()->post('nautika-api-call/email/sendmail.php', $data);
    }


    public function TestGreenOceanAPICall($pnr)
    {
        $godata['pnr'] = $pnr;
        // $godata['pnr'] = "TPMHE";
        $hash_sequence = "pnr|public_key";
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY'); // Public Key Shared by Green Ocean
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence); // Hash value of sequenced string

        // $booking_json = json_encode($godata);
        // dd($godata);

        echo "PNR: $pnr<br>";

        $booking_api_res = $this->greenOceanApiCall('ticket-pnr', $godata);

        $booking_data = DB::table('pnr_status as ps')
            ->select('b.*','ps.pnr_id', 'fl.name as form_location', 'tl.name as to_location')
            ->join('booking as b','b.id','=','ps.booking_id')
            ->join('locations as fl','fl.id','=','b.from_location')
            ->join('locations as tl','tl.id','=','b.to_location')
            ->where(['ps.pnr_id' => $pnr])
            ->toSql();

        // dd($booking_api_res);
        dd($booking_data);

    }
}
