<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\Payments; 
use DB;

class RazorpayController extends Controller
{
    // public function payment($id): Response{
    
    //   $amount =Session::get('amount');     

    //     $api = new Api(env('RAZOR_KEY_ID'), env('RAZOR_KEY_SECRET'));
    //     $order= $api->order->create(array('receipt'=>"ord", 'amount'=>$amount * 100, 'currency'=>'INR')); 
    //     $order_id= $order['id'];
  
    //     return response()->view('package.razorpay_payment', compact('order_id'));
    // }

    // public function store(Request $request)
    // {
    //     $input = $request->all();

    //     $api = new Api(env('RAZOR_KEY_ID'), env('RAZOR_KEY_SECRET'));
    
    //     $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
    //     if(count($input)  && !empty($input['razorpay_payment_id'])) {
    //         try {
    //             $response = $api->payment->fetch($input['razorpay_payment_id']); 
    //             $card = $response['card'] ?? NULL;
    //             $card_type = $card['type'];
    //             $card_last4 = $card['last4'];
    //             $user_id=Session::get('get_user_id');
    //             $package_id=$input['package_id'];
    //             $package_booking_details_id=$input['package_booking_details_id'];

    //                 // echo "<pre>";
    //                 // print_r($package_booking_details_id);
    //                 // die();

    //             $payment = Payments::create([
    //                 'user_id' => $user_id,
    //                 'package_id' =>  $package_id,
    //                 'payment_id' => $response['id'],
    //                 'package_booking_details_id' => $package_booking_details_id,
    //                 'amount' => $response['amount'],
    //                 'currency' => $response['currency'],
    //                 'card_id' => $response['card_id'],
    //                 'payment_method' => $response['method'],
    //                 'order_id' => $response['order_id'], 
    //                 'card_type' =>  $card_type , 
    //                 'card_last4' => $card_last4, 
    //                 'payment_status' => $response['status'], 
    //                 'json_response'=> json_encode((array)$response)
    //             ]);

    //             function generateRandom($length) {
    //                 $random = '';
    //                 for ($i = 0; $i < $length; $i++) {
    //                     $random .= random_int(1, 9);
    //                 }
    //                 return $random;
    //             }                   
    //             $random = generateRandom(10);
    //             $payment_status= $response['status'];
    //             echo  $payment_status;

    //             if($payment_status=='captured'){
    //                 $payment_status='success';
    //             }else{
    //                 $payment_status='failed';
    //             }

    //             DB::table('package_booking_details')
    //             ->where('custom_package_id', $package_id)  
    //             ->update([
    //                 'order_id' => $response['order_id'], 
    //                 'invoice_id' =>$random , 
    //                 'payment_status' => $payment_status,
    //                 'updated_at' => now(),
    //             ]);


    //         } catch (Exception $e) {
    //             return  $e->getMessage();
    //             Session::put('error',$e->getMessage());
    //             return redirect()->back();
    //         }
    //     }
          
    //     Session::put('success', 'Payment successful');
    //     return redirect()->back();
    // }

    // public function payment_success(){
    //     $booking_id= Session::get('booking_id');
    //     $results=DB::table('booking')->select('*')->where('id', $booking_id)->first();
    //     $booking_ts= $results->departure_time;
    //     echo $booking_ts;
    //     die();
    //     $data2 = array(
    //         'schedule_id' => date('d-m-Y', strtotime($date)),
    //         'from' => $fromN,
    //         'to' =>  $toN,

    //     );

    //     return view('package.payment_success');
    // }
}
