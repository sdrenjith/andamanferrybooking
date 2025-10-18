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
        $data['passengers'] = $request->query('passengers');
        $data['infants'] = $request->query('infants');

        // Validate required parameters
        if (!$data['boatScheduleId']) {
            return redirect()->back()->with('error', 'Boat schedule ID is required.');
        }

        if (!$data['date']) {
            return redirect()->back()->with('error', 'Date is required.');
        }

        if (!$data['passengers']) {
            return redirect()->back()->with('error', 'Number of passengers is required.');
        }

        $date = Carbon::parse($data['date']);
        $data['formattedDate'] = $date->format('D, d M, Y');

        $data['boat_datas'] = DB::table('boat_schedule')
            ->where('id', $data['boatScheduleId'])
            ->where('status', 'Y')
            ->first();

        // Validate that boat schedule exists
        if (!$data['boat_datas']) {
            return redirect()->back()->with('error', 'Selected boat schedule is not available.');
        }

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

    public function booking_show_boat_summary(Request $request)
    {
        // Get form data from the boat booking form
        $data['boat_name'] = $request->boat_name;
        $data['date'] = $request->date;
        $data['passengers'] = $request->passengers;
        $data['infants'] = $request->infants;

        // Validate required fields (only boat selection, date, and passengers)
        if (!$data['boat_name'] || !$data['date'] || !$data['passengers']) {
            return redirect()->back()->with('error', 'Please fill in all required fields.');
        }

        // Get boat details from BoatCustomBooking table (same as dropdown)
        $data['boat_datas'] = DB::table('boat_custom_booking')
            ->where('name', $data['boat_name'])
            ->where('status', 'Y')
            ->first();

        if (!$data['boat_datas']) {
            return redirect()->back()->with('error', 'Selected boat is not available.');
        }

        // Use the price from BoatCustomBooking (same as dropdown)
        $data['boat_price'] = $data['boat_datas']->price;
        $data['multi_price'] = $data['boat_price'] * $data['passengers'];
        $data['boatScheduleId'] = $data['boat_datas']->id;

        // Format date
        $date = Carbon::parse($data['date']);
        $data['formattedDate'] = $date->format('D, d M, Y');

        return view('booking.bokingpage.booking-summary-boat', $data);
    }

    public function boat_booking(Request $request)
    {
        // Validate required fields
        if (!$request->boatScheduleId) {
            return redirect()->back()->with('error', 'Boat schedule ID is required. Please select a valid boat schedule.');
        }

        $rand_number = rand(100, 999);

        $timestamp = time();
        $timestamp_last7 = substr($timestamp, -7);
        $combined = $rand_number . $timestamp_last7;

        $orderId = substr($combined, 0, 10);

        $user = Auth::user();
        $user_id = $user->id ?? NULL;

        // Get passenger details from the form
        $passengerNames = $request->input('passenger_name', []);
        $passengerTitles = $request->input('passenger_title', []);
        $passengerDobs = $request->input('passenger_dob', []);
        
        // Use the first passenger as the primary contact
        $primaryName = !empty($passengerNames) ? $passengerNames[1] : '';
        $primaryTitle = !empty($passengerTitles) ? $passengerTitles[1] : '';
        $primaryDob = !empty($passengerDobs) ? $passengerDobs[1] : '';

        try {
            $lastInsertedId = DB::table('booking')->insertGetId([
                'schedule_id' => $request->boatScheduleId,
                'type' => $request->type,
                'order_id' => $orderId,
                'c_name' => $primaryName,
                'c_email' => $request->customer_email ?? '',
                'c_mobile' => $request->customer_phone ?? '',
                'c_contact' => $request->customer_phone ?? '',
                'payment_status' => 'pending',
                'ship_name' => $request->boat_name ?? NULL,
                'amount' => $request->amount,
                'no_of_passenger' => $request->no_of_passenger,
                'date_of_jurney' => $request->date_of_jurney,
                'user_id' => $user_id
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create booking. Please try again. Error: ' . $e->getMessage());
        }

        if (!empty($lastInsertedId)) {
            $passengerTitles = $request->input('passenger_title', []);
            $passengerNames = $request->input('passenger_name', []);
            $passengerDobs = $request->input('passenger_dob', []);
            $passengerGenders = $request->input('passenger_gender', []);
            $passengerNationalities = $request->input('passenger_nationality', []);
            $country_name = $request->input('country_name', []);
            $passport_id = $request->input('passport_id', []);
            $expiry_date = $request->input('expiry_date', []);

            // Insert passenger details if available
            if (is_array($passengerTitles) && is_array($passengerNames) && is_array($passengerDobs) && 
                count($passengerTitles) === count($passengerNames) && count($passengerNames) === count($passengerDobs)) {

                foreach ($passengerTitles as $index => $title) {
                    // Handle date fields properly - use NULL instead of empty string for dates
                    $dobValue = null;
                    $expiryDateValue = null;
                    
                    // Only set date values if they are not empty and valid
                    if (!empty($passengerDobs[$index]) && $passengerDobs[$index] !== '') {
                        $dobValue = $passengerDobs[$index];
                    }
                    
                    if (!empty($expiry_date[$index]) && $expiry_date[$index] !== '') {
                        $expiryDateValue = $expiry_date[$index];
                    }
                    
                    $passengerData = [
                        'booking_id' => $lastInsertedId,
                        'title' => $passengerTitles[$index] ?? '',
                        'full_name' => $passengerNames[$index] ?? '',
                        'dob' => $dobValue,
                        'gender' => $passengerGenders[$index] ?? '',
                        'resident' => $passengerNationalities[$index] ?? 'Indian',
                        'country' => $country_name[$index] ?? 'India',
                        'passport_id' => $passport_id[$index] ?? '',
                        'expiry_date' => $expiryDateValue,
                        'trip_type' => 'Boat',
                    ];

                    DB::table('booking_passenger_details')->insert($passengerData);
                }

                // PhonePe Integration
                Session::put('booking_id', $lastInsertedId);
                Session::put('amount', $request->amount);
                Session::put('user_phone', $request->c_mobile);
                Session::put('user_email', $request->c_email);
                Session::put('user_name', $request->c_name);
                
                return redirect()->route('phonepe.boat.initiate');
            } else {
                return redirect()->back()->with('error', 'Passenger details are incomplete or mismatched.');
            }
        }

        return redirect()->back()->with('error', 'Booking creation failed.');
    }

    public function boatPaymentPage($order_id, Request $request)
    {
        // Log ALL incoming parameters first for debugging
        \Log::info('Boat Payment Callback - All Parameters', [
            'order_id' => $order_id,
            'all_params' => $request->all(),
            'url' => $request->fullUrl()
        ]);
        
        // Get booking details from session or database
        $booking_id = Session::get('booking_id');
        
        if (!$booking_id) {
            \Log::error('Boat Payment - No booking_id in session', [
                'order_id' => $order_id,
                'session_data' => Session::all()
            ]);
            return redirect()->route('home')->with('error', 'Booking session expired. Please start a new booking.');
        }
        
        $booking = DB::table('booking')->where('id', $booking_id)->first();
        
        if (!$booking) {
            \Log::error('Boat Payment - Booking not found', [
                'booking_id' => $booking_id,
                'order_id' => $order_id
            ]);
            return redirect()->route('home')->with('error', 'Booking not found.');
        }
        
        // Get payment parameters
        $payment_status = $request->get('status');
        $payment_id = $request->get('payment_id');
        $error_code = $request->get('error_code');
        $error_description = $request->get('error_description');
        $razorpay_payment_id = $request->get('razorpay_payment_id');
        $razorpay_order_id = $request->get('razorpay_order_id');
        $razorpay_signature = $request->get('razorpay_signature');
        
        // Additional PhonePe parameters
        $transactionId = $request->get('transactionId');
        $code = $request->get('code'); // PhonePe also sends 'code' parameter
        
        // Log detailed payment callback info
        \Log::info('Boat Payment Callback - Parsed Data', [
            'order_id' => $order_id,
            'booking_id' => $booking_id,
            'payment_status' => $payment_status,
            'payment_id' => $payment_id,
            'transactionId' => $transactionId,
            'code' => $code,
            'error_code' => $error_code,
            'error_description' => $error_description,
            'razorpay_payment_id' => $razorpay_payment_id,
            'current_booking_status' => $booking->payment_status
        ]);
        
        // ============= HANDLE RAZORPAY PAYMENTS =============
        if ($razorpay_payment_id && $razorpay_order_id && $razorpay_signature) {
            \Log::info('Processing Razorpay payment', ['booking_id' => $booking_id]);
            
            $generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, env('RAZORPAY_KEY_SECRET'));
            
            if (hash_equals($generated_signature, $razorpay_signature)) {
                // Payment successful
                DB::table('booking')
                    ->where('id', $booking_id)
                    ->update([
                        'payment_status' => 'confirmed',
                        'razorpay_payment_id' => $razorpay_payment_id,
                        'updated_at' => now()
                    ]);
                
                \Log::info('Razorpay payment successful', ['booking_id' => $booking_id]);
                
                // Send confirmation email
                $this->sendBookingConfirmationEmail($booking, $order_id);
                
                // Redirect to ferry booking success page
                return redirect()->route('ferry-booking.success', ['order_id' => $order_id]);
            } else {
                // Invalid signature
                \Log::error('Razorpay signature verification failed', ['booking_id' => $booking_id]);
                
                DB::table('booking')
                    ->where('id', $booking_id)
                    ->update([
                        'payment_status' => 'failed',
                        'updated_at' => now()
                    ]);
                
                return redirect()->route('boat_booking_page')->with('error', 'Payment verification failed. Please try again.');
            }
        }
        
        // ============= HANDLE PHONEPE CANCELLATION/FAILURE =============
        // Check for various cancellation/failure scenarios from PhonePe
        $isCancelled = (
            $payment_status === 'CANCELLED' || 
            $payment_status === 'FAILED' || 
            $payment_status === 'CANCELLED_BY_USER' ||
            $payment_status === 'PAYMENT_ERROR' ||
            $payment_status === 'PAYMENT_DECLINED' ||
            $code === 'PAYMENT_CANCELLED' ||
            $code === 'PAYMENT_ERROR' ||
            !empty($error_code) ||
            $request->has('error') // Generic error parameter
        );
        
        if ($isCancelled) {
            \Log::info('PhonePe payment cancelled/failed', [
                'booking_id' => $booking_id,
                'payment_status' => $payment_status,
                'code' => $code,
                'error_code' => $error_code,
                'error_description' => $error_description
            ]);
            
            // Update booking status to cancelled
            DB::table('booking')
                ->where('id', $booking_id)
                ->update([
                    'payment_status' => 'cancelled',
                    'payment_failed_reason' => $error_description ?? 'Payment cancelled by user',
                    'updated_at' => now()
                ]);
            
            return redirect()->route('boat_booking_page')->with('error', 'Payment was cancelled or failed. Please try again.');
        }
        
        // ============= HANDLE PHONEPE SUCCESS =============
        if (($payment_status === 'SUCCESS' || $payment_status === 'COMPLETED') && ($payment_id || $transactionId)) {
            \Log::info('PhonePe payment successful', [
                'booking_id' => $booking_id,
                'payment_id' => $payment_id,
                'transactionId' => $transactionId
            ]);
            
            // Update booking status to confirmed
            DB::table('booking')
                ->where('id', $booking_id)
                ->update([
                    'payment_status' => 'confirmed',
                    'razorpay_payment_id' => $payment_id ?? $transactionId,
                    'updated_at' => now()
                ]);
            
            $data = [
                'booking' => $booking,
                'order_id' => $order_id,
                'booking_id' => $booking_id
            ];
            
            return view('razorpay.success', $data);
        }
        
        // ============= HANDLE PENDING/AMBIGUOUS CASES =============
        // If booking is confirmed (from a previous successful payment), show success
        if ($booking->payment_status === 'confirmed') {
            \Log::info('Booking already confirmed, showing success page', ['booking_id' => $booking_id]);
            
            $data = [
                'booking' => $booking,
                'order_id' => $order_id,
                'booking_id' => $booking_id
            ];
            
            return view('razorpay.success', $data);
        }
        
        // If booking is cancelled or failed, redirect to booking page
        if (in_array($booking->payment_status, ['cancelled', 'failed'])) {
            \Log::info('Booking was cancelled/failed, redirecting to booking page', [
                'booking_id' => $booking_id,
                'status' => $booking->payment_status
            ]);
            
            return redirect()->route('boat_booking_page')->with('error', 'Payment was not completed. Please try again.');
        }
        
        // Default case: Payment is pending or status is unclear
        // DO NOT show success page, redirect to booking page instead
        \Log::warning('Payment status unclear, redirecting to booking page', [
            'booking_id' => $booking_id,
            'booking_status' => $booking->payment_status,
            'payment_status' => $payment_status,
            'all_params' => $request->all()
        ]);
        
        // If this is a direct URL access (no payment parameters), it's likely a cancellation
        if (empty($payment_status) && empty($razorpay_payment_id) && empty($payment_id) && empty($transactionId)) {
            \Log::info('Direct URL access detected - likely payment cancellation', [
                'booking_id' => $booking_id,
                'url' => $request->fullUrl()
            ]);
            
            // Update booking status to cancelled if it's still pending
            if ($booking->payment_status === 'pending') {
                DB::table('booking')
                    ->where('id', $booking_id)
                    ->update([
                        'payment_status' => 'cancelled',
                        'payment_failed_reason' => 'Payment cancelled by user',
                        'updated_at' => now()
                    ]);
            }
        }
        
        return redirect()->route('boat_booking_page')->with('error', 'Payment was not completed. Please try again.');
    }

    public function ferryBookingSuccess($order_id, Request $request)
    {
        // Get booking details from database using order_id
        $booking = DB::table('booking')->where('order_id', $order_id)->first();
        
        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking not found.');
        }
        
        // Get all related bookings for this order
        $allBookings = DB::table('booking')->where('order_id', $order_id)->get();
        
        // Get passenger details
        $passengerDetails = DB::table('booking_passenger_details')
            ->whereIn('booking_id', $allBookings->pluck('id'))
            ->get();
        
        $data = [
            'booking' => $booking,
            'allBookings' => $allBookings,
            'passengerDetails' => $passengerDetails,
            'order_id' => $order_id,
            'booking_id' => $booking->id
        ];
        
        return view('booking.ferry.ferry-booking-success', $data);
    }

    public function boatPaymentSuccess($order_id, Request $request)
    {
        // Get booking details from session or database
        $booking_id = Session::get('booking_id');
        
        if (!$booking_id) {
            return redirect()->route('home')->with('error', 'Booking session expired. Please start a new booking.');
        }
        
        $booking = DB::table('booking')->where('id', $booking_id)->first();
        
        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking not found.');
        }
        
        // Get payment details from PhonePe
        $payment_id = $request->get('payment_id');
        $transaction_id = $request->get('transaction_id');
        
        // Log successful payment
        \Log::info('Boat Payment Success', [
            'order_id' => $order_id,
            'booking_id' => $booking_id,
            'payment_id' => $payment_id,
            'transaction_id' => $transaction_id
        ]);
        
        // Update booking status to confirmed
        DB::table('booking')
            ->where('id', $booking_id)
            ->update([
                'payment_status' => 'confirmed',
                'razorpay_payment_id' => $payment_id,
                'updated_at' => now()
            ]);
        
        // Send confirmation email
        $this->sendBookingConfirmationEmail($booking, $order_id);
        
        $data = [
            'booking' => $booking,
            'order_id' => $order_id,
            'booking_id' => $booking_id
        ];
        
        return view('razorpay.success', $data);
    }

    public function boatPaymentCancel($order_id, Request $request)
    {
        // Get booking details from session or database
        $booking_id = Session::get('booking_id');
        
        if (!$booking_id) {
            return redirect()->route('home')->with('error', 'Booking session expired. Please start a new booking.');
        }
        
        $booking = DB::table('booking')->where('id', $booking_id)->first();
        
        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking not found.');
        }
        
        // Log cancelled payment
        \Log::info('Boat Payment Cancelled', [
            'order_id' => $order_id,
            'booking_id' => $booking_id,
            'reason' => $request->get('reason', 'User cancelled payment')
        ]);
        
        // Update booking status to cancelled
        DB::table('booking')
            ->where('id', $booking_id)
            ->update([
                'payment_status' => 'cancelled',
                'updated_at' => now()
            ]);
        
        // Redirect to boat booking page with error message
        return redirect()->route('boat_booking_page')->with('error', 'Payment was cancelled. Please try again.');
    }

    public function paymentFailed($order_id, Request $request)
    {
        // Get booking details
        $booking_id = Session::get('booking_id');
        
        if (!$booking_id) {
            return response()->json(['error' => 'Booking session expired'], 400);
        }
        
        // Update booking status to failed
        DB::table('booking')
            ->where('id', $booking_id)
            ->update([
                'payment_status' => 'failed',
                'payment_failed_reason' => $request->get('reason', 'Payment failed'),
                'updated_at' => now()
            ]);
        
        \Log::info('Payment Failed', [
            'order_id' => $order_id,
            'booking_id' => $booking_id,
            'reason' => $request->get('reason', 'Payment failed')
        ]);
        
        return response()->json(['success' => true]);
    }

    private function sendBookingConfirmationEmail($booking, $order_id)
    {
        try {
            // Get all bookings for this order
            $allBookings = DB::table('booking')->where('order_id', $order_id)->get();
            
            // Get passenger details for the main booking
            $passengerDetails = DB::table('booking_passenger_details')
                ->where('booking_id', $booking->id)
                ->get();
            
            // Prepare email data for the booking-confirmation template
            $emailData = [
                'booking' => $booking,
                'allBookings' => $allBookings,
                'passengerDetails' => $passengerDetails,
                'order_id' => $order_id
            ];
            
            // Send email using Laravel Mail with booking-confirmation template
            \Mail::send('emails.booking-confirmation', $emailData, function($message) use ($booking) {
                $message->to($booking->c_email, $booking->c_name)
                        ->subject('Ferry Booking Confirmation - Order #' . $booking->order_id);
            });
            
            \Log::info('Booking confirmation email sent using booking-confirmation template', [
                'order_id' => $order_id,
                'email' => $booking->c_email
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send booking confirmation email', [
                'order_id' => $order_id,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function ajaxBoatBooking(Request $request)
    {
        // Validate required fields (only boat selection, date, passengers, and amount)
        $validator = Validator::make($request->all(), [
            'boat_name' => 'required|string',
            'date_of_jurney' => 'required|date',
            'no_of_passenger' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        // Generate order ID
        $combined = time() . rand(1000, 9999);
        $orderId = substr($combined, 0, 10);

        $user = Auth::user();
        $user_id = $user->id ?? NULL;

        try {
            $lastInsertedId = DB::table('booking')->insertGetId([
                'schedule_id' => null, // For boat bookings, this might be null
                'type' => 'boat',
                'order_id' => $orderId,
                'c_name' => '', // Will be filled in summary page
                'c_email' => '', // Will be filled in summary page
                'c_mobile' => '', // Will be filled in summary page
                'c_contact' => '', // Will be filled in summary page
                'payment_status' => 'pending',
                'ship_name' => $request->boat_name,
                'amount' => $request->amount,
                'no_of_passenger' => $request->no_of_passenger,
                'date_of_jurney' => $request->date_of_jurney,
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if ($lastInsertedId) {
                // Store booking ID in session for payment processing
                Session::put('booking_id', $lastInsertedId);
                
                return response()->json([
                    'success' => true,
                    'order_id' => $orderId,
                    'booking_id' => $lastInsertedId
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to create booking'], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Boat booking creation failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            return response()->json(['success' => false, 'message' => 'Booking creation failed'], 500);
        }
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

        if (!empty($booking_data) && !empty($ferry_list)) {

            // ===================== FETCH LOCATION TITLES ==================================
            // Get location titles for proper display
            $fromLocationTitle = \App\Models\FerryLocation::where('id', $booking_data['form_location'])->first();
            $toLocationTitle = \App\Models\FerryLocation::where('id', $booking_data['to_location'])->first();
            
            $data['from_location_title'] = $fromLocationTitle ? $fromLocationTitle->title : 'Unknown';
            $data['to_location_title'] = $toLocationTitle ? $toLocationTitle->title : 'Unknown';
            
            // For round trips, get return location titles
            if ($booking_data['trip_type'] >= 2) {
                $returnFromLocationTitle = \App\Models\FerryLocation::where('id', $booking_data['return_from_location'])->first();
                $returnToLocationTitle = \App\Models\FerryLocation::where('id', $booking_data['return_to_location'])->first();
                
                $data['return_from_location_title'] = $returnFromLocationTitle ? $returnFromLocationTitle->title : 'Unknown';
                $data['return_to_location_title'] = $returnToLocationTitle ? $returnToLocationTitle->title : 'Unknown';
            }
            
            // For triple trips, get additional location titles
            if ($booking_data['trip_type'] == 3) {
                $round2FromLocationTitle = \App\Models\FerryLocation::where('id', $booking_data['round2_from_location'])->first();
                $round2ToLocationTitle = \App\Models\FerryLocation::where('id', $booking_data['round2_to_location'])->first();
                
                $data['round2_from_location_title'] = $round2FromLocationTitle ? $round2FromLocationTitle->title : 'Unknown';
                $data['round2_to_location_title'] = $round2ToLocationTitle ? $round2ToLocationTitle->title : 'Unknown';
            }

            // ===================== TRIP 1 ==================================
            $trip1FerryList = $ferry_list['apiScheduleData'];
            $ferryScheduleId = $booking_data['schedule'][1]['scheduleId'];
            $ferryScheduleType = $booking_data['schedule'][1]['ship'];

            $passenger = $booking_data['no_of_passenger'];
            $infants = $booking_data['no_of_infant'];

            $scheduleDet1 = null;
            foreach ($trip1FerryList as $row) {
                if ($row['id'] == $ferryScheduleId && $row['ship_name'] == $ferryScheduleType) {
                    $scheduleDet1 = $row;
                    break;
                }
            }

            $selectedSche1 = [];

            if ($scheduleDet1 && $scheduleDet1['ship_name'] == 'Admin') {
                $selectedSche1['fare'] = 0; // Default fare
                $selectedSche1['class_title'] = 'Standard'; // Default class
                foreach ($scheduleDet1['ferry_prices'] as $row) {
                    if ($row['class_id'] == $booking_data['schedule'][1]['shipClass']) {
                        $selectedSche1['fare'] = $row['price'];
                        $selectedSche1['class_title'] = $row['class']['title'];
                        break; // Exit loop once found
                    }
                }

                $selectedSche1['class_id'] = $booking_data['schedule'][1]['shipClass'];
                $selectedSche1['schedule_id'] = $booking_data['schedule'][1]['scheduleId'];
                $selectedSche1['trip_id'] = NULL;
                $selectedSche1['ship_name'] = $scheduleDet1['ship']['title'];
                $selectedSche1['departure_time'] = $scheduleDet1['departure_time'];
                $selectedSche1['arrival_time'] = $scheduleDet1['arrival_time'];
                $selectedSche1['psf'] = 0;
                $selectedSche1['route_id'] = NULL;
            } else if ($scheduleDet1 && ($scheduleDet1['ship_name'] == 'Nautika' || $scheduleDet1['ship_name'] == 'Makruzz' || str_contains($scheduleDet1['ship_name'], 'Green Ocean'))) {
                if ($booking_data['schedule'][1]['shipClass'] == 'bClass') {
                    $selectedSche1['fare'] = 200;
                    $selectedSche1['class_title'] = 'Business';
                } else if ($booking_data['schedule'][1]['shipClass'] == 'pClass') {
                    $selectedSche1['fare'] = 200;
                    $selectedSche1['class_title'] = 'Premium';
                }
                $selectedSche1['infantFare'] = 200;
                $selectedSche1['schedule_id'] = $scheduleDet1['id'];
                $selectedSche1['class_id'] = $booking_data['schedule'][1]['shipClass'];
                $selectedSche1['ship_name'] = $scheduleDet1['ship_name'];
                $selectedSche1['departure_time'] = $scheduleDet1['departure_time'];
                $selectedSche1['arrival_time'] = $scheduleDet1['arrival_time'] ?? $scheduleDet1['aTime'] ?? null;
                $selectedSche1['trip_id'] = $scheduleDet1['tripId'] ?? $scheduleDet1['id'] ?? null;
                $selectedSche1['vesselID'] = $scheduleDet1['vesselID'] ?? $scheduleDet1['vessel_id'] ?? null;
                $selectedSche1['psf'] = 0;
                $selectedSche1['route_id'] = NULL;
                $selectedSche1['tripSeatNo'] = $booking_data['schedule'][1]['tripSeatNo'] ?? null;
            }

            // Ensure trip1 has required keys even if no ferry found
            if (empty($selectedSche1)) {
                $selectedSche1 = [
                    'ship_name' => 'Unknown',
                    'fare' => 0,
                    'class_title' => 'Standard',
                    'departure_time' => '00:00:00',
                    'arrival_time' => '00:00:00',
                    'psf' => 0
                ];
            }
            $data['trip1'] = $selectedSche1;

            // ============================ TRIP 2 =====================================================
            if ($booking_data['trip_type'] >= 2) {
                // For round trips, return journey data is in apiScheduleData3, not apiScheduleData2
                $trip2FerryList = $ferry_list['apiScheduleData3'];
                $ferryScheduleId = $booking_data['schedule'][2]['scheduleId'];
                $ferryScheduleType = $booking_data['schedule'][2]['ship'];

                $scheduleDet2 = null;
                // Try to find the ferry by ID and ship name
                foreach ($trip2FerryList as $row) {
                    if ($row['id'] == $ferryScheduleId && $row['ship_name'] == $ferryScheduleType) {
                        $scheduleDet2 = $row;
                        break;
                    }
                }
                
                // If not found, try to find by ID only (for Admin ferries)
                if (!$scheduleDet2) {
                    foreach ($trip2FerryList as $row) {
                        if ($row['id'] == $ferryScheduleId) {
                            $scheduleDet2 = $row;
                            break;
                        }
                    }
                }

                $selectedSche2 = [];

                if ($scheduleDet2 && $scheduleDet2['ship_name'] == 'Admin') {
                    $selectedSche2['fare'] = 0; // Default fare
                    $selectedSche2['class_title'] = 'Standard'; // Default class
                    foreach ($scheduleDet2['ferry_prices'] as $row) {
                        if ($row['class_id'] == $booking_data['schedule'][2]['shipClass']) {
                            $selectedSche2['fare'] = $row['price'];
                            $selectedSche2['class_title'] = $row['class']['title'];
                            break; // Exit loop once found
                        }
                    }

                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['schedule_id'] = $booking_data['schedule'][2]['scheduleId'];
                    $selectedSche2['trip_id'] = NULL;
                    $selectedSche2['ship_name'] = $scheduleDet2['ship']['title'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    $selectedSche2['arrival_time'] = $scheduleDet2['arrival_time'];
                    $selectedSche2['psf'] = 0;
                    $selectedSche2['route_id'] = NULL;

                } else if ($scheduleDet2 && ($scheduleDet2['ship_name'] == 'Nautika' || $scheduleDet2['ship_name'] == 'Makruzz' || str_contains($scheduleDet2['ship_name'], 'Green Ocean'))) {
                    if ($booking_data['schedule'][2]['shipClass'] == 'bClass') {
                        $selectedSche2['fare'] = 200;
                        $selectedSche2['class_title'] = 'Business';
                    } else if ($booking_data['schedule'][2]['shipClass'] == 'pClass') {
                        $selectedSche2['fare'] = 200;
                        $selectedSche2['class_title'] = 'Premium';
                    }
                    $selectedSche2['infantFare'] = 200;
                    $selectedSche2['schedule_id'] = $scheduleDet2['id'];
                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['ship_name'] = $scheduleDet2['ship_name'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    $selectedSche2['arrival_time'] = $scheduleDet2['arrival_time'] ?? $scheduleDet2['aTime'] ?? null;
                    $selectedSche2['trip_id'] = $scheduleDet2['tripId'] ?? $scheduleDet2['id'] ?? null;
                    $selectedSche2['vesselID'] = $scheduleDet2['vesselID'] ?? $scheduleDet2['vessel_id'] ?? null;
                    $selectedSche2['route_id'] = NULL;
                    $selectedSche2['psf'] = 0;
                    $selectedSche2['tripSeatNo'] = $booking_data['schedule'][2]['tripSeatNo'] ?? null;
                } else if ($scheduleDet2 && $scheduleDet2['ship_name'] == 'Makruzz') {
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
                } else if ($scheduleDet2 && str_contains($scheduleDet2['ship_name'], 'Green Ocean')) {
                    $selectedSche2['class_id'] = $booking_data['schedule'][2]['shipClass'];
                    $selectedSche2['schedule_id'] = $booking_data['schedule'][2]['scheduleId'];
                    $selectedSche2['trip_id'] = NULL;
                    $selectedSche2['ship_id'] = $booking_data['schedule'][2]['ship_id'];
                    $selectedSche2['ship_name'] = $scheduleDet2['ship_name'];
                    $selectedSche2['departure_time'] = $scheduleDet2['departure_time'];
                    $selectedSche2['arrival_time'] = $scheduleDet2['arraival_time'];
                    $selectedSche2['route_id'] = $booking_data['schedule'][2]['route_id'];
                    $selectedSche2['trip_seat_no'] = $booking_data['schedule'][2]['tripSeatNo'];

                    foreach ($scheduleDet2['ship_class'] as $sch) {
                        if ($sch->class_id == $booking_data['schedule'][2]['shipClass']) {
                            $selectedSche2['fare'] = $sch->adult_seat_rate;
                            $selectedSche2['psf'] = $sch->port_fee;
                            $selectedSche2['class_title'] = $sch->class_name;
                        }
                    }
                }

                // Ensure trip2 has required keys even if no ferry found
                if (empty($selectedSche2)) {
                    $selectedSche2 = [
                        'ship_name' => 'Unknown',
                        'fare' => 0,
                        'class_title' => 'Standard',
                        'departure_time' => '00:00:00',
                        'arrival_time' => '00:00:00',
                        'psf' => 0
                    ];
                }
                $data['trip2'] = $selectedSche2;
            }

            // ============================ TRIP 3 =====================================================
            if ($booking_data['trip_type'] == 3) {
                $trip3FerryList = $ferry_list['apiScheduleData3'];
                $ferryScheduleId = $booking_data['schedule'][3]['scheduleId'];
                $ferryScheduleType = $booking_data['schedule'][3]['ship'];

                $scheduleDet3 = null;
                foreach ($trip3FerryList as $row) {
                    if ($row['id'] == $ferryScheduleId && $row['ship_name'] == $ferryScheduleType) {
                        $scheduleDet3 = $row;
                        break;
                    }
                }
                $selectedSche3 = [];

                if ($scheduleDet3 && $scheduleDet3['ship_name'] == 'Admin') {
                    $selectedSche3['fare'] = 0; // Default fare
                    $selectedSche3['class_title'] = 'Standard'; // Default class
                    foreach ($scheduleDet3['ferry_prices'] as $row) {
                        if ($row['class_id'] == $booking_data['schedule'][3]['shipClass']) {
                            $selectedSche3['fare'] = $row['price'];
                            $selectedSche3['class_title'] = $row['class']['title'];
                            break; // Exit loop once found
                        }
                    }

                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['schedule_id'] = $booking_data['schedule'][3]['scheduleId'];
                    $selectedSche3['trip_id'] = NULL;
                    $selectedSche3['ship_name'] = $scheduleDet3['ship']['title'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    $selectedSche3['arrival_time'] = $scheduleDet3['arrival_time'];
                    $selectedSche3['psf'] = 0;
                    $selectedSche3['route_id'] = NULL;

                } else if ($scheduleDet3 && ($scheduleDet3['ship_name'] == 'Nautika' || $scheduleDet3['ship_name'] == 'Makruzz' || str_contains($scheduleDet3['ship_name'], 'Green Ocean'))) {
                    if ($booking_data['schedule'][3]['shipClass'] == 'bClass') {
                        $selectedSche3['fare'] = 200;
                        $selectedSche3['class_title'] = 'Business';
                    } else if ($booking_data['schedule'][3]['shipClass'] == 'pClass') {
                        $selectedSche3['fare'] = 200;
                        $selectedSche3['class_title'] = 'Premium';
                    }
                    $selectedSche3['infantFare'] = 200;
                    $selectedSche3['schedule_id'] = $scheduleDet3['id'];
                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['ship_name'] = $scheduleDet3['ship_name'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    $selectedSche3['arrival_time'] = $scheduleDet3['arrival_time'] ?? $scheduleDet3['aTime'] ?? null;
                    $selectedSche3['trip_id'] = $scheduleDet3['tripId'] ?? $scheduleDet3['id'] ?? null;
                    $selectedSche3['vesselID'] = $scheduleDet3['vesselID'] ?? $scheduleDet3['vessel_id'] ?? null;
                    $selectedSche3['psf'] = 0;
                    $selectedSche3['tripSeatNo'] = $booking_data['schedule'][3]['tripSeatNo'] ?? null;
                    $selectedSche3['route_id'] = NULL;
                } else if ($scheduleDet3 && $scheduleDet3['ship_name'] == 'Makruzz') {
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
                } else if ($scheduleDet3 && str_contains($scheduleDet3['ship_name'], 'Green Ocean')) {
                    $selectedSche3['class_id'] = $booking_data['schedule'][3]['shipClass'];
                    $selectedSche3['schedule_id'] = $booking_data['schedule'][3]['scheduleId'];
                    $selectedSche3['trip_id'] = NULL;
                    $selectedSche3['ship_id'] = $booking_data['schedule'][3]['ship_id'];
                    $selectedSche3['ship_name'] = $scheduleDet3['ship_name'];
                    $selectedSche3['departure_time'] = $scheduleDet3['departure_time'];
                    $selectedSche3['arrival_time'] = $scheduleDet3['arraival_time'];
                    $selectedSche3['route_id'] = $booking_data['schedule'][3]['route_id'];
                    $selectedSche3['trip_seat_no'] = $booking_data['schedule'][3]['tripSeatNo'];
                    foreach ($scheduleDet3['ship_class'] as $sch) {
                        if ($sch->class_id == $booking_data['schedule'][3]['shipClass']) {
                            $selectedSche3['fare'] = $sch->adult_seat_rate;
                            $selectedSche3['psf'] = $sch->port_fee;
                            $selectedSche3['class_title'] = $sch->class_name;
                        }
                    }
                }

                // Ensure trip3 has required keys even if no ferry found
                if (empty($selectedSche3)) {
                    $selectedSche3 = [
                        'ship_name' => 'Unknown',
                        'fare' => 0,
                        'class_title' => 'Standard',
                        'departure_time' => '00:00:00',
                        'arrival_time' => '00:00:00',
                        'psf' => 0
                    ];
                }
                $data['trip3'] = $selectedSche3;
            }

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
                'trip_id'  => (int) $trip_data['trip1']['trip_id'],
                'route_id'  => $trip_data['trip1']['route_id'],
                'vessel_id'  => (int) ($trip_data['trip1']['vesselID'] ?? 0),
                'departure_time'  => $trip_data['trip1']['departure_time'],
                'arrival_time'  => $trip_data['trip1']['arrival_time'] ?? null,
                'nautika_class'  =>  $trip_data['trip1']['ship_name'] == 'Nautika' ? $trip_data['trip1']['class_id'] : NULL,
                'makruzz_class'  => $trip_data['trip1']['ship_name'] == 'Makruzz' ? $trip_data['trip1']['class_id'] : NULL,
                'green_ocean_class'  => $trip_data['booking_data']['schedule'][1] == 'Admin' ? $trip_data['trip1']['class_id'] : NULL,
                'ferry_class'  => $trip_data['trip1']['class_title'] ?? 'Standard',
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
                'date_of_jurney'  => $trip_data['booking_data']['departure_date'],
                'trip_id'  => (int) $trip_data['trip2']['trip_id'],
                'route_id'  => $trip_data['trip2']['route_id'],
                'vessel_id'  => (int) ($trip_data['trip2']['vesselID'] ?? 0),
                'departure_time'  => $trip_data['trip2']['departure_time'],
                'arrival_time'  => $trip_data['trip2']['arrival_time'] ?? null,
                'nautika_class'  =>  $trip_data['trip2']['ship_name'] == 'Nautika' ? $trip_data['trip2']['class_id'] : NULL,
                'makruzz_class'  => $trip_data['trip2']['ship_name'] == 'Makruzz' ? $trip_data['trip2']['class_id'] : NULL,
                'green_ocean_class'  => $trip_data['booking_data']['schedule'][1] == 'Admin' ? $trip_data['trip2']['class_id'] : NULL,
                'ferry_class'  => $trip_data['trip2']['class_title'] ?? 'Standard',
                'from_location'  => $trip_data['booking_data']['departure_from_location'],
                'to_location'  => $trip_data['booking_data']['departure_to_location'],
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
                'trip_id'  => (int) $trip_data['trip3']['trip_id'],
                'route_id'  => $trip_data['trip3']['route_id'],
                'vessel_id'  => (int) ($trip_data['trip3']['vesselID'] ?? 0),
                'departure_time'  => $trip_data['trip3']['departure_time'],
                'arrival_time'  => $trip_data['trip3']['arrival_time'] ?? null,
                'nautika_class'  =>  $trip_data['trip3']['ship_name'] == 'Nautika' ? $trip_data['trip3']['class_id'] : NULL,
                'makruzz_class'  => $trip_data['trip3']['ship_name'] == 'Makruzz' ? $trip_data['trip3']['class_id'] : NULL,
                'green_ocean_class'  => $trip_data['booking_data']['schedule'][1] == 'Admin' ? $trip_data['trip3']['class_id'] : NULL,
                'ferry_class'  => $trip_data['trip3']['class_title'] ?? 'Standard',
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

                foreach ($passengerTitles as $index => $title) {
                    if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip1']['ship_name'] != 'Nautika') {
                        $paxFare = 0;
                    } else if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip1']['ship_name'] == 'Nautika') {
                        $paxFare = $trip_data['trip1']['infantFare'];
                    } else {
                        $paxFare = $trip_data['trip1']['fare'] ?? 200;
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

                // PhonePe Integration - Store session data
                Session::put('user_phone', $request->c_mobile);
                Session::put('user_email', $request->c_email);
                Session::put('user_name', $request->c_name);
                Session::put('booking_id', $trip1_booking_id);
                Session::put('trip_type', $trip_type);
                    
                if (!empty($trip2_booking_id)) {
                    foreach ($passengerTitles as $index => $title) {
                        if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip2']['ship_name'] != 'Nautika') {
                            $paxFare = 0;
                        } else if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip2']['ship_name'] == 'Nautika') {
                            $paxFare = $trip_data['trip2']['infantFare'];
                        } else {
                            $paxFare = $trip_data['trip2']['fare'] ?? 200;
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
                        if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip3']['ship_name'] != 'Nautika') {
                            $paxFare = 0;
                        } else if ($passengerDobs[$index] <= 1 && $passengerTitles[$index] == 'INFANT' && $trip_data['trip3']['ship_name'] == 'Nautika') {
                            $paxFare = $trip_data['trip3']['infantFare'];
                        } else {
                            $paxFare = $trip_data['trip3']['fare'] ?? 200;
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
                
                return redirect()->route('phonepe.ferry.initiate');
            }
        }
    }

    /**
     * NEW METHOD: Handle Ferry Booking APIs after successful payment
     * This method is called from PhonePeController after payment verification
     * 
     * COMMENTED OUT: All API calls to Nautika, Makruzz, and Green Ocean
     * Reason: Manual processing - team will handle bookings directly
     * Bookings are marked as "Pending Confirmation" in pnr_status table
     */
    public function handleFerryBookingAPIs($booking_id, $trip2_booking_id = null, $trip3_booking_id = null)
    {
        $trip_data = Session::get('trip_data');
        
        if (!$trip_data) {
            \Log::error('Trip data not found in session for booking API processing', [
                'booking_id' => $booking_id
            ]);
            return;
        }

        // ================= TRIP 1 PROCESSING =================
        $results = DB::table('booking')->where('id', $booking_id)->first();
        $passenger_result = DB::table('booking_passenger_details')->where('booking_id', $booking_id)->get();

        if ($results->ship_name == 'Admin') {
            // Admin bookings - No API call needed, direct confirmation
            $booking_response = [
                'booking_id' => $booking_id,
                'pnr_id' => NULL,
                'booking_status' => 'Confirmed',
                'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                'seat_status' => 1,
                'booking_vendor' => 'Admin',
            ];
            DB::table('pnr_status')->insert($booking_response);
            
        } else if ($results->ship_name == 'Nautika') {
            // ===== NAUTIKA API CALL - COMMENTED OUT =====
            // \Log::info('Nautika booking - API call commented out, will be processed manually', [
            //     'booking_id' => $booking_id,
            //     'ship_name' => $results->ship_name
            // ]);
            
            /*
            // COMMENTED OUT - Original Nautika API Call
            $departure_time = $results->departure_time;
            $booking_ts = Carbon::createFromFormat('H:i:s', $departure_time)->timestamp;

            list($adults, $infants) = $passenger_result->partition(function ($passenger) {
                return $passenger->title !== 'INFANT';
            });

            $bClassSeats = [];
            $pClassSeats = [];
            $seatss = json_decode($trip_data['trip1']['tripSeatNo'] ?? '[]');

            if ($trip_data['trip1']['class_id'] === 'pClass') {
                $pClassSeats = $seatss;
            } else if ($trip_data['trip1']['class_id'] === 'bClass') {
                $bClassSeats = $seatss;
            }

            // ... Rest of Nautika API call code commented out ...
            // $nautika_booked_details = $this->nautikaApiCall('bookSeats', $finalData);
            */

            // Insert pending confirmation record
            $booking_response = [
                'booking_id' => $booking_id,
                'pnr_id' => NULL,
                'booking_status' => 'Pending Confirmation',
                'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                'seat_status' => 0,
                'booking_vendor' => 'Nautika',
            ];
            DB::table('pnr_status')->insert($booking_response);
            
        } else if ($results->ship_name == 'Makruzz') {
            // ===== MAKRUZZ API CALL - COMMENTED OUT =====
            // \Log::info('Makruzz booking - API call commented out, will be processed manually', [
            //     'booking_id' => $booking_id,
            //     'ship_name' => $results->ship_name
            // ]);
            
            /*
            // COMMENTED OUT - Original Makruzz API Call
            $passengers = [];
            foreach ($passenger_result as $key => $passenger) {
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
            // ... Rest of Makruzz API call code commented out ...
            // $makruzz_booked_details = $this->makApiCall('savePassengers', $data_json);
            */

            // Insert pending confirmation record
            $booking_response = [
                'booking_id' => $booking_id,
                'pnr_id' => 'PENDING_' . $booking_id,
                'booking_status' => 'Pending Confirmation',
                'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                'seat_status' => 0,
                'booking_vendor' => 'Makruzz',
            ];
            DB::table('pnr_status')->insert($booking_response);
            
        } else if (str_contains($results->ship_name, 'Green Ocean')) {
            // ===== GREEN OCEAN API CALL - COMMENTED OUT =====
            // \Log::info('Green Ocean booking - API call commented out, will be processed manually', [
            //     'booking_id' => $booking_id,
            //     'ship_name' => $results->ship_name
            // ]);
            
            /*
            // COMMENTED OUT - Original Green Ocean API Call
            $hash_sequence = "ship_id|from_id|dest_to|route_id|class_id|number_of_adults|number_of_infants|travel_date|seat_id|public_key";
            $godata['ship_id'] = $trip_data['trip1']['ship_id'];
            $godata['from_id'] = $results->from_location;
            // ... Rest of Green Ocean API call code commented out ...
            // $booking_api_res = $this->greenOceanApiCall('book-ticket', $godata);
            */

            // Insert pending confirmation record
            $booking_response = [
                'booking_id' => $booking_id,
                'pnr_id' => NULL,
                'booking_status' => 'Pending Confirmation',
                'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                'seat_status' => 0,
                'booking_vendor' => $results->ship_name,
            ];
            DB::table('pnr_status')->insert($booking_response);
            
        } else if ($results->ship_name == 'ITT Majestic') {
            // ITT Majestic - No API needed
            $booking_response = [
                'booking_id' => $booking_id,
                'pnr_id' => NULL,
                'booking_status' => 'Confirmed',
                'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                'seat_status' => 1,
                'booking_vendor' => $results->ship_name,
            ];
            DB::table('pnr_status')->insert($booking_response);
        }

        // ================= TRIP 2 PROCESSING (if exists) =================
        if (!empty($trip2_booking_id)) {
            $results2 = DB::table('booking')->where('id', $trip2_booking_id)->first();
            $passenger_result2 = DB::table('booking_passenger_details')->where('booking_id', $trip2_booking_id)->get();

            if ($results2->ship_name == 'Admin') {
                $booking_response2 = [
                    'booking_id' => $trip2_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Confirmed',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 1,
                    'booking_vendor' => 'Admin',
                ];
                DB::table('pnr_status')->insert($booking_response2);
                
            } else if ($results2->ship_name == 'Nautika') {
                // NAUTIKA API CALL COMMENTED OUT FOR TRIP 2
                $booking_response2 = [
                    'booking_id' => $trip2_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Pending Confirmation',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 0,
                    'booking_vendor' => 'Nautika',
                ];
                DB::table('pnr_status')->insert($booking_response2);
                
            } else if ($results2->ship_name == 'Makruzz') {
                // MAKRUZZ API CALL COMMENTED OUT FOR TRIP 2
                $booking_response2 = [
                    'booking_id' => $trip2_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Pending Confirmation',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 0,
                    'booking_vendor' => 'Makruzz',
                ];
                DB::table('pnr_status')->insert($booking_response2);
                
            } else if (str_contains($results2->ship_name, 'Green Ocean')) {
                // GREEN OCEAN API CALL COMMENTED OUT FOR TRIP 2
                $booking_response2 = [
                    'booking_id' => $trip2_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Pending Confirmation',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 0,
                    'booking_vendor' => $results2->ship_name,
                ];
                DB::table('pnr_status')->insert($booking_response2);
                
            } else if ($results2->ship_name == 'ITT Majestic') {
                $booking_response2 = [
                    'booking_id' => $trip2_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Confirmed',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 1,
                    'booking_vendor' => $results2->ship_name,
                ];
                DB::table('pnr_status')->insert($booking_response2);
            }
        }

        // ================= TRIP 3 PROCESSING (if exists) =================
        if (!empty($trip3_booking_id)) {
            $results3 = DB::table('booking')->where('id', $trip3_booking_id)->first();
            $passenger_result3 = DB::table('booking_passenger_details')->where('booking_id', $trip3_booking_id)->get();

            if ($results3->ship_name == 'Admin') {
                $booking_response3 = [
                    'booking_id' => $trip3_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Confirmed',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 1,
                    'booking_vendor' => 'Admin',
                ];
                DB::table('pnr_status')->insert($booking_response3);
                
            } else if ($results3->ship_name == 'Nautika') {
                // NAUTIKA API CALL COMMENTED OUT FOR TRIP 3
                $booking_response3 = [
                    'booking_id' => $trip3_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Pending Confirmation',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 0,
                    'booking_vendor' => 'Nautika',
                ];
                DB::table('pnr_status')->insert($booking_response3);
                
            } else if ($results3->ship_name == 'Makruzz') {
                // MAKRUZZ API CALL COMMENTED OUT FOR TRIP 3
                $booking_response3 = [
                    'booking_id' => $trip3_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Pending Confirmation',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 0,
                    'booking_vendor' => 'Makruzz',
                ];
                DB::table('pnr_status')->insert($booking_response3);
                
            } else if (str_contains($results3->ship_name, 'Green Ocean')) {
                // GREEN OCEAN API CALL COMMENTED OUT FOR TRIP 3
                $booking_response3 = [
                    'booking_id' => $trip3_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Pending Confirmation',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 0,
                    'booking_vendor' => $results3->ship_name,
                ];
                DB::table('pnr_status')->insert($booking_response3);
                
            } else if ($results3->ship_name == 'ITT Majestic') {
                $booking_response3 = [
                    'booking_id' => $trip3_booking_id,
                    'pnr_id' => NULL,
                    'booking_status' => 'Confirmed',
                    'razorpay_payment_id' => 'PHONEPE_' . $booking_id,
                    'seat_status' => 1,
                    'booking_vendor' => $results3->ship_name,
                ];
                DB::table('pnr_status')->insert($booking_response3);
            }
        }

        \Log::info('Ferry booking API processing completed (with API calls commented out)', [
            'booking_id' => $booking_id,
            'trip2_booking_id' => $trip2_booking_id,
            'trip3_booking_id' => $trip3_booking_id
        ]);
    }

    // ========== KEEP EXISTING METHODS BELOW (NOT USED WITH PHONEPE) ==========

    public function payment_response(Request $request, $order_id)
    {
        // THIS METHOD IS FOR RAZORPAY - NOT USED WITH PHONEPE
        // Keeping for backward compatibility
        
        if (Auth::id()) {
            $userId = Auth::id();
        } else {
            $userId = NULL;
        }

        $success = true;
        $error = "payment_failed";

        if (empty($_POST['razorpay_payment_id']) === false) {
            $api_key  = env("RAZOR_KEY_ID");
            $api_secret = env("RAZOR_KEY_SECRET");
            $api = new Api($api_key, $api_secret);
            try {
                $attributes = array(
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
                'created_at' => !empty($payment['created_at']) ? date('Y-m-d H:i:s', strtotime($payment['created_at'])) : NULL
            );

            $success = RazorpayPaymentDetail::create($tran_data);

            if ($success) {
                $booking_id = Session::get('booking_id');
                $booking_type = $request->get('type', 'ferry');
                
                if ($booking_type === 'boat') {
                    DB::table('booking')->where('id', $booking_id)->update(['payment_status' => 'success']);
                } else {
                    $inserted_trip2_booking_id = Session::get('trip2_booking_id');
                    $inserted_trip3_booking_id = Session::get('trip3_booking_id');
                    
                    DB::table('booking')->where('id', $booking_id)->update(['payment_status' => 'success']);
                    if ($inserted_trip2_booking_id) {
                        DB::table('booking')->where('id', $inserted_trip2_booking_id)->update(['payment_status' => 'success']);
                    }
                    if ($inserted_trip3_booking_id) {
                        DB::table('booking')->where('id', $inserted_trip3_booking_id)->update(['payment_status' => 'success']);
                    }
                }
                
                $data = [
                    'order_id' => $order_id,
                    'user_id' => $userId,
                    'payment_details' => $tran_data
                ];

                if ($booking_type === 'boat') {
                    $data['booking_id'] = $booking_id;
                    $data['order_id'] = $order_id;
                    
                    Session::forget(['order_id', 'amount', 'user_phone', 'user_email', 'user_name', 'booking_id']);
                    
                    return view('razorpay.success', $data);
                }

                // Ferry booking - Call the new method with API calls commented out
                $this->handleFerryBookingAPIs(
                    $booking_id,
                    Session::get('trip2_booking_id'),
                    Session::get('trip3_booking_id')
                );

                return view('razorpay.success', $data);
            }
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
        $data['bookings'] = DB::table('booking')->where('id', $booking_id)->get();
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
        try {
            // Try Laravel Mail first
            $details = [
                'booking_id' => $booking_id,
                'trip2_booking_id' => $trip2_booking_id,
                'trip3_booking_id' => $trip3_booking_id,
                'greet' => $greet,
            ];

            Mail::to($user_email)->send(new TestMail($details));
            \Log::info('Laravel Mail sent successfully', ['email' => $user_email]);
            
        } catch (\Exception $e) {
            \Log::error('Laravel Mail failed, trying PHP mailer', [
                'error' => $e->getMessage(),
                'email' => $user_email
            ]);
            
            // Fallback to PHP mailer
            try {
                $result = \App\Helpers\PHPMailerHelper::sendBookingConfirmationEmail(
                    $user_email,
                    $booking_id,
                    $trip2_booking_id,
                    $trip3_booking_id,
                    $greet
                );
                
                if ($result) {
                    \Log::info('PHP mailer sent successfully', ['email' => $user_email]);
                } else {
                    \Log::error('PHP mailer also failed', ['email' => $user_email]);
                }
            } catch (\Exception $phpMailerError) {
                \Log::error('PHP mailer error', [
                    'error' => $phpMailerError->getMessage(),
                    'email' => $user_email
                ]);
            }
        }

        return 'Email has been sent!';
    }

    public function sendMailMakruzz($booking_id, $pnr)
    {
        $bookingDetails = DB::table('booking')->where('id', $booking_id)->first();

        $data = array(
            'bookingDetails' => (array) $bookingDetails,
            'pnr' => $pnr
        );

        $response = Http::withHeaders([
            'debug' => true,
            'Accept' => 'application/json'
        ])->timeout(20)->withoutVerifying()->post('nautika-api-call/email/sendmail.php', $data);
    }

    public function sendMailGreenOcean($pnr)
    {
        $godata['pnr'] = $pnr;
        $hash_sequence = "pnr|public_key";
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY');
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence);

        $booking_api_res = $this->greenOceanApiCall('ticket-pnr', $godata);

        if ($booking_api_res->status == 'success' && $booking_api_res->data->status == 'Okay') {
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

            $ticketTemplate = view('emails.green-ocean-mail-template', ['booking_data' => $booking_data])->render();
            $user_email = $booking_data->c_email;

            $data = array(
                'subject' => "Book my ferry booking mail",
                'mail_body' => $ticketTemplate,
                'email' => $user_email
            );

            $response = Http::withHeaders([
                'debug' => true,
                'Accept' => 'application/json'
            ])->timeout(20)->withoutVerifying()->post('nautika-api-call/email/sendmailgo.php', $data);
        } else {
            echo $booking_api_res->message;
        }
    }

    public function TestGreenOceanAPICall($pnr)
    {
        $godata['pnr'] = $pnr;
        $hash_sequence = "pnr|public_key";
        $godata['public_key'] = env('GREEN_OCEAN_PUBLIC_KEY');
        $godata['hash_string'] = $this->getHashKey($godata, env('GREEN_OCEAN_PRIVATE_KEY'), $hash_sequence);

        echo "PNR: $pnr<br>";

        $booking_api_res = $this->greenOceanApiCall('ticket-pnr', $godata);

        $booking_data = DB::table('pnr_status as ps')
            ->select('b.*','ps.pnr_id', 'fl.name as form_location', 'tl.name as to_location')
            ->join('booking as b','b.id','=','ps.booking_id')
            ->join('locations as fl','fl.id','=','b.from_location')
            ->join('locations as tl','tl.id','=','b.to_location')
            ->where(['ps.pnr_id' => $pnr])
            ->toSql();

        dd($booking_data);
    }

    public function boat_booking_payment(Request $request)
    {
        // Validate payment status from Razorpay
        $razorpay_payment_id = $request->razorpay_payment_id;
        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_signature = $request->razorpay_signature;
        
        // Verify payment signature
        $generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, env('RAZORPAY_KEY_SECRET'));
        
        if (!hash_equals($generated_signature, $razorpay_signature)) {
            return redirect()->back()->with('error', 'Payment verification failed. Please try again.');
        }
        
        // Get booking details
        $booking_id = $request->booking_id;
        $order_id = $request->order_id;
        
        if (!$booking_id || !$order_id) {
            return redirect()->back()->with('error', 'Invalid booking details.');
        }
        
        // Update booking status to confirmed
        DB::table('booking')
            ->where('id', $booking_id)
            ->where('order_id', $order_id)
            ->update([
                'payment_status' => 'confirmed',
                'razorpay_payment_id' => $razorpay_payment_id,
                'updated_at' => now()
            ]);
        
        // Redirect to success page
        return redirect()->route('boat-payment-success', ['order_id' => $order_id]);
    }
}