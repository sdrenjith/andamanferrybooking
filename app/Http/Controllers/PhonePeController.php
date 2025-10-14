<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use PhonePe\Env;
use PhonePe\payments\v2\standardCheckout\StandardCheckoutClient;
use PhonePe\payments\v2\models\request\builders\StandardCheckoutPayRequestBuilder;
use PhonePe\common\exceptions\PhonePeException;
use App\Helpers\PHPMailerHelper;

class PhonePeController extends Controller
{
    private $phonePeClient;
    private $webhookUsername;
    private $webhookPassword;

    public function __construct()
    {
        $clientId = env('PHONEPE_CLIENT_ID');
        $clientVersion = env('PHONEPE_CLIENT_VERSION');
        $clientSecret = env('PHONEPE_CLIENT_SECRET');
        $env = Env::PRODUCTION;
        
        $this->phonePeClient = StandardCheckoutClient::getInstance(
            $clientId,
            $clientVersion,
            $clientSecret,
            $env
        );

        $this->webhookUsername = env('PHONEPE_WEBHOOK_USERNAME');
        $this->webhookPassword = env('PHONEPE_WEBHOOK_PASSWORD');
    }

    /**
     * Helper method to safely update booking
     */
    private function updateBooking($booking_id, $data)
    {
        $columnExists = Schema::hasColumn('booking', 'phonepe_order_id');
        
        if (!$columnExists && isset($data['phonepe_order_id'])) {
            unset($data['phonepe_order_id']);
        }
        
        DB::table('booking')->where('id', $booking_id)->update($data);
    }

    /**
     * Store payment metadata in database before redirect
     */
    private function storePaymentMetadata($transactionId, $metadata, $amountInPaise = null)
    {
        if (Schema::hasTable('phonepe_payment_details')) {

            $hasMetadataCol = Schema::hasColumn('phonepe_payment_details', 'metadata');

            $row = [
                'merchant_transaction_id' => $transactionId,
                'transaction_id'          => null,
                'amount'                  => $amountInPaise ? ($amountInPaise / 100.0) : 0,
                'currency'                => 'INR',
                'status'                  => 'INITIATED',
                'payment_method'          => null,
                'created_at'              => Carbon::now(),
            ];

            if ($hasMetadataCol) {
                $row['metadata'] = json_encode($metadata);
            } else {
                $row['response_data'] = json_encode(['metadata' => $metadata]);
            }

            DB::table('phonepe_payment_details')->insert($row);

        } else {
            if (isset($metadata['booking_id'])) {
                DB::table('booking')->where('id', $metadata['booking_id'])->update([
                    'phonepe_transaction_id' => $transactionId
                ]);
            }
        }
    }

    /**
     * Retrieve payment metadata
     */
    private function getPaymentMetadata($transactionId)
    {
        if (Schema::hasTable('phonepe_payment_details')) {
            $result = DB::table('phonepe_payment_details')
                ->where('merchant_transaction_id', $transactionId)
                ->orderBy('id', 'desc')
                ->first();
                
            if ($result) {
                return json_decode($result->metadata, true);
            }
        }
        
        $booking = DB::table('booking')
            ->where('phonepe_transaction_id', $transactionId)
            ->first();
            
        if ($booking) {
            $metadata = [
                'booking_id' => $booking->id,
                'booking_type' => $booking->type,
                'user_email' => $booking->c_email,
                'user_phone' => $booking->c_mobile,
                'user_name' => $booking->c_name
            ];
            
            if ($booking->type == 'ferry') {
                $relatedBookings = DB::table('booking')
                    ->where('phonepe_transaction_id', $transactionId)
                    ->where('id', '!=', $booking->id)
                    ->get();
                    
                foreach ($relatedBookings as $index => $related) {
                    if ($related->trip_type == 'Trip 2') {
                        $metadata['trip2_booking_id'] = $related->id;
                    } elseif ($related->trip_type == 'Trip 3') {
                        $metadata['trip3_booking_id'] = $related->id;
                    }
                }
            }
            
            return $metadata;
        }
        
        return null;
    }

    /**
     * Centralized exception handler for PhonePe operations
     */
    private function handlePhonePeException(PhonePeException $e, $context = [])
    {
        \Log::error('PhonePe Exception Occurred', [
            'context' => $context,
            'error_code' => $e->getCode(),
            'message' => $e->getMessage(),
            'http_status_code' => $e->getHttpStatusCode(),
            'error_data' => $e->getData(),
            'trace' => $e->getTraceAsString()
        ]);

        $httpStatusCode = $e->getHttpStatusCode();
        
        if ($httpStatusCode >= 500) {
            return 'PhonePe service is temporarily unavailable. Please try again in a few minutes.';
        } elseif ($httpStatusCode == 401 || $httpStatusCode == 403) {
            return 'Payment service authentication failed. Please contact support.';
        } elseif ($httpStatusCode == 400) {
            return 'Invalid payment request. Please check your details and try again.';
        } else {
            return 'Payment initialization failed: ' . $e->getMessage();
        }
    }

    /**
     * Initiate payment for boat booking
     */
    public function initiateBoatPayment(Request $request)
    {
        try {
            $booking_id = Session::get('booking_id');
            
            if (!$booking_id) {
                return redirect()->back()->with('error', 'Booking session expired');
            }

            $booking = DB::table('booking')->where('id', $booking_id)->first();
            
            if (!$booking) {
                return redirect()->back()->with('error', 'Booking not found');
            }

            $merchantOrderId = 'BOAT' . time() . rand(1000, 9999);
            $amountInPaise = $booking->amount * 100;

            \Log::info('Initiating Boat Payment', [
                'booking_id' => $booking_id,
                'merchant_order_id' => $merchantOrderId,
                'amount_paise' => $amountInPaise
            ]);

            $metadata = [
                'booking_id' => $booking_id,
                'booking_type' => 'boat',
                'user_phone' => Session::get('user_phone') ?? $booking->c_mobile,
                'user_email' => Session::get('user_email') ?? $booking->c_email,
                'user_name' => Session::get('user_name') ?? $booking->c_name,
                'amount' => Session::get('amount') ?? $booking->amount
            ];
            
            $this->storePaymentMetadata($merchantOrderId, $metadata, $amountInPaise);

            $this->updateBooking($booking_id, [
                'phonepe_transaction_id' => $merchantOrderId,
                'payment_status' => 'pending',
                'updated_at' => Carbon::now()
            ]);

            $payRequest = StandardCheckoutPayRequestBuilder::builder()
                ->merchantOrderId($merchantOrderId)
                ->amount($amountInPaise)
                ->redirectUrl(url('/phonepe/callback'))
                ->message('Boat Booking Payment')
                ->build();

            $payResponse = $this->phonePeClient->pay($payRequest);

            \Log::info('Boat Payment Response', [
                'state' => $payResponse->getState(),
                'order_id' => $payResponse->getOrderId()
            ]);

            if ($payResponse->getState() === 'PENDING') {
                $this->updateBooking($booking_id, [
                    'phonepe_order_id' => $payResponse->getOrderId(),
                    'updated_at' => Carbon::now()
                ]);

                return redirect($payResponse->getRedirectUrl());
            } else {
                \Log::error('Boat payment state not PENDING', [
                    'state' => $payResponse->getState()
                ]);
                return redirect()->back()->with('error', 'Payment initiation failed. Please try again.');
            }

        } catch (PhonePeException $e) {
            $errorMessage = $this->handlePhonePeException($e, [
                'operation' => 'initiateBoatPayment',
                'booking_id' => $booking_id ?? null
            ]);
            return redirect()->back()->with('error', $errorMessage);
            
        } catch (\Exception $e) {
            \Log::error('Boat Payment General Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    /**
     * Initiate payment for ferry booking
     */
    public function initiateFerryPayment(Request $request)
    {
        \Log::info('=== FERRY PAYMENT INITIATION START ===');

        try {
            $booking_id = Session::get('booking_id');
            $trip2_booking_id = Session::get('trip2_booking_id');
            $trip3_booking_id = Session::get('trip3_booking_id');
            $trip_data = Session::get('trip_data');
            $trip_type = Session::get('trip_type');

            if (!$booking_id) {
                return redirect()->back()->with('error', 'Session expired. Please try again.');
            }

            $booking = DB::table('booking')->where('id', $booking_id)->first();
            
            if (!$booking) {
                return redirect()->back()->with('error', 'Booking not found.');
            }

            $totalAmount = $booking->amount;
            if ($trip2_booking_id) {
                $trip2 = DB::table('booking')->where('id', $trip2_booking_id)->first();
                if ($trip2) $totalAmount += $trip2->amount;
            }
            if ($trip3_booking_id) {
                $trip3 = DB::table('booking')->where('id', $trip3_booking_id)->first();
                if ($trip3) $totalAmount += $trip3->amount;
            }

            if (Session::has('total_amount')) {
                $totalAmount = Session::get('total_amount');
            }

            $amountInPaise = $totalAmount * 100;
            $merchantOrderId = 'FERRY' . time() . rand(1000, 9999);
            
            \Log::info('Ferry Payment Details', [
                'booking_id' => $booking_id,
                'amount_paise' => $amountInPaise,
                'merchant_order_id' => $merchantOrderId,
                'trip2_booking_id' => $trip2_booking_id,
                'trip3_booking_id' => $trip3_booking_id
            ]);

            $metadata = [
                'booking_id' => $booking_id,
                'booking_type' => 'ferry',
                'trip_type' => $trip_type,
                'trip2_booking_id' => $trip2_booking_id,
                'trip3_booking_id' => $trip3_booking_id,
                'trip_data' => $trip_data,
                'user_phone' => Session::get('user_phone') ?? $booking->c_mobile,
                'user_email' => Session::get('user_email') ?? $booking->c_email,
                'user_name' => Session::get('user_name') ?? $booking->c_name,
                'total_amount' => $totalAmount
            ];
            
            $this->storePaymentMetadata($merchantOrderId, $metadata, $amountInPaise);

            $this->updateBooking($booking_id, [
                'phonepe_transaction_id' => $merchantOrderId,
                'payment_status' => 'pending',
                'updated_at' => Carbon::now()
            ]);

            if ($trip2_booking_id) {
                $this->updateBooking($trip2_booking_id, [
                    'phonepe_transaction_id' => $merchantOrderId,
                    'payment_status' => 'pending',
                    'updated_at' => Carbon::now()
                ]);
            }

            if ($trip3_booking_id) {
                $this->updateBooking($trip3_booking_id, [
                    'phonepe_transaction_id' => $merchantOrderId,
                    'payment_status' => 'pending',
                    'updated_at' => Carbon::now()
                ]);
            }

            $payRequest = StandardCheckoutPayRequestBuilder::builder()
                ->merchantOrderId($merchantOrderId)
                ->amount($amountInPaise)
                ->redirectUrl(url('/phonepe/callback'))
                ->message('Ferry Booking Payment')
                ->build();

            $payResponse = $this->phonePeClient->pay($payRequest);
            
            \Log::info('Ferry Payment Response', [
                'state' => $payResponse->getState(),
                'order_id' => $payResponse->getOrderId()
            ]);

            if ($payResponse->getState() === 'PENDING') {
                $updateData = [
                    'phonepe_order_id' => $payResponse->getOrderId(),
                    'updated_at' => Carbon::now()
                ];
                
                $this->updateBooking($booking_id, $updateData);
                if ($trip2_booking_id) {
                    $this->updateBooking($trip2_booking_id, $updateData);
                }
                if ($trip3_booking_id) {
                    $this->updateBooking($trip3_booking_id, $updateData);
                }

                \Log::info('Redirecting to PhonePe', ['url' => $payResponse->getRedirectUrl()]);

                return redirect($payResponse->getRedirectUrl());
            } else {
                \Log::error('Ferry payment state not PENDING', [
                    'state' => $payResponse->getState()
                ]);
                return redirect()->back()->with('error', 'Payment initialization failed. Please try again.');
            }

        } catch (PhonePeException $e) {
            $errorMessage = $this->handlePhonePeException($e, [
                'operation' => 'initiateFerryPayment',
                'booking_id' => $booking_id ?? null
            ]);
            return redirect()->back()->with('error', $errorMessage);
            
        } catch (\Exception $e) {
            \Log::error('Ferry Payment General Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    /**
     * Handle redirect callback (Main handler for payment completion)
     */
    public function handleCallback(Request $request)
    {
        try {
            \Log::info('PhonePe Redirect Callback', [
                'data' => $request->all(),
                'query_params' => $request->query(),
                'session_data' => Session::all()
            ]);

            // Try multiple ways to get the transaction ID
            $merchantOrderId = 
                  $request->input('orderId')
               ?? $request->input('merchantOrderId')
               ?? $request->input('transactionId')
               ?? $request->query('orderId')
               ?? $request->query('merchantOrderId')
               ?? $request->query('transactionId')
               ?? data_get($request->all(), 'payload.merchantOrderId')
               ?? data_get($request->all(), 'payload.orderId')
               ?? Session::get('phonepe_transaction_id')
               ?? Session::get('booking_id'); // Fallback to booking ID

            // If still no transaction ID, try to get from URL parameters
            if (!$merchantOrderId) {
                $url = $request->fullUrl();
                if (preg_match('/[?&]orderId=([^&]+)/', $url, $matches)) {
                    $merchantOrderId = $matches[1];
                } elseif (preg_match('/[?&]merchantOrderId=([^&]+)/', $url, $matches)) {
                    $merchantOrderId = $matches[1];
                }
            }

            \Log::info('Transaction ID extraction', [
                'merchantOrderId' => $merchantOrderId,
                'request_method' => $request->method(),
                'request_uri' => $request->getRequestUri()
            ]);

            if (!$merchantOrderId) {
                \Log::error('No transaction ID in callback', [
                    'request_data' => $request->all(),
                    'session_data' => Session::all()
                ]);
                
                // Try to get the most recent booking and send email anyway
                $recentBooking = DB::table('booking')
                    ->where('payment_status', 'pending')
                    ->orderBy('id', 'desc')
                    ->first();
                    
                if ($recentBooking) {
                    \Log::info('Found recent pending booking, processing email', [
                        'booking_id' => $recentBooking->id
                    ]);
                    
                    // Update booking status
                    DB::table('booking')
                        ->where('id', $recentBooking->id)
                        ->update(['payment_status' => 'success']);
                    
                    // Send email
                    $this->sendEmailForBooking($recentBooking->id);
                    
                    return redirect()->route('phonepe.success', ['transaction_id' => $recentBooking->id]);
                }
                
                return redirect()->route('home')->with('error', 'Invalid payment session');
            }

            $orderId        = data_get($request->all(), 'payload.orderId');
            $payloadState   = data_get($request->all(), 'payload.state');
            $paymentDetails = data_get($request->all(), 'payload.paymentDetails.0');
            $gatewayTxnId   = data_get($paymentDetails, 'transactionId');
            $paymentMode    = data_get($paymentDetails, 'paymentMode');

            $statusCheckResponse = $this->phonePeClient->getOrderStatus($merchantOrderId, true);
            $state = $statusCheckResponse->getState();

            \Log::info('Order Status Check', [
                'merchant_order_id' => $merchantOrderId,
                'state' => $state,
                'amount' => $statusCheckResponse->getAmount()
            ]);

            if (\Schema::hasTable('phonepe_payment_details')) {
                DB::table('phonepe_payment_details')
                    ->where('merchant_transaction_id', $merchantOrderId)
                    ->update([
                        'transaction_id' => $gatewayTxnId,
                        'status'         => $state,
                        'payment_method' => $paymentMode,
                        'response_data'  => json_encode($request->all()),
                        'updated_at'     => Carbon::now(),
                    ]);
            }

            if ($state === 'COMPLETED') {
                DB::table('booking')
                    ->where('phonepe_transaction_id', $merchantOrderId)
                    ->update([
                        'payment_status' => 'success',
                        'updated_at'     => Carbon::now()
                    ]);

                $metadata = $this->getPaymentMetadata($merchantOrderId) ?? [
                    'booking_type' => optional(DB::table('booking')
                        ->where('phonepe_transaction_id', $merchantOrderId)->first())->type
                ];

                if (($metadata['booking_type'] ?? null) === 'boat') {
                    $this->handleBoatBookingSuccess($metadata);
                } else {
                    $this->handleFerryBookingSuccess($metadata);
                }

                return redirect()->route('phonepe.success', ['transaction_id' => $merchantOrderId]);

            } else {
                DB::table('booking')
                    ->where('phonepe_transaction_id', $merchantOrderId)
                    ->update([
                        'payment_status' => 'failed',
                        'updated_at'     => Carbon::now()
                    ]);

                return redirect()->route('phonepe.failed', ['transaction_id' => $merchantOrderId]);
            }

        } catch (PhonePeException $e) {
            $this->handlePhonePeException($e, [
                'operation' => 'handleCallback',
                'merchant_order_id' => $merchantOrderId ?? null
            ]);
            return redirect()->route('home')->with('error', 'Payment verification failed. Please contact support.');
        } catch (\Exception $e) {
            \Log::error('Callback Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('home')->with('error', 'Payment verification failed');
        }
    }

    /**
     * Handle boat booking success
     * UPDATED: No API calls - just creates PNR status
     */
    private function handleBoatBookingSuccess($metadata)
    {
        $booking_id = $metadata['booking_id'];
        
        // Create PNR status entry - Boat bookings confirmed immediately
        DB::table('pnr_status')->insert([
            'booking_id' => $booking_id,
            'pnr_id' => NULL,
            'booking_status' => 'Confirmed',
            'razorpay_payment_id' => NULL,
            'seat_status' => 1,
            'booking_vendor' => 'Boat'
        ]);

        \Log::info('Boat booking confirmed', ['booking_id' => $booking_id]);

        // Send email if available
        if (isset($metadata['user_email'])) {
            try {
                $emailSent = PHPMailerHelper::sendBookingConfirmationEmail(
                    $metadata['user_email'],
                    $booking_id,
                    null,
                    null,
                    ''
                );
                
                if ($emailSent) {
                    \Log::info('Boat booking email sent successfully', ['booking_id' => $booking_id]);
                } else {
                    \Log::error('Failed to send boat booking email', ['booking_id' => $booking_id]);
                }
            } catch (\Exception $e) {
                \Log::error('Boat email error', ['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Handle ferry booking success
     * UPDATED: Calls BookingController->handleFerryBookingAPIs() method
     * All API calls are commented out in that method
     */
    private function handleFerryBookingSuccess($metadata)
    {
        $booking_id = $metadata['booking_id'];
        $trip2_booking_id = $metadata['trip2_booking_id'] ?? null;
        $trip3_booking_id = $metadata['trip3_booking_id'] ?? null;
        $trip_data = $metadata['trip_data'] ?? null;

        if (!$trip_data) {
            \Log::error('Trip data not found in metadata', ['booking_id' => $booking_id]);
            return;
        }

        // Restore session data for compatibility
        Session::put('booking_id', $booking_id);
        Session::put('trip2_booking_id', $trip2_booking_id);
        Session::put('trip3_booking_id', $trip3_booking_id);
        Session::put('trip_data', $trip_data);
        Session::put('phonepe_transaction_id', $metadata['phonepe_transaction_id'] ?? null);
        Session::put('user_email', $metadata['user_email'] ?? null);
        Session::put('trip_type', $metadata['trip_type'] ?? null);

        \Log::info('Ferry booking - calling handleFerryBookingAPIs', [
            'booking_id' => $booking_id,
            'trip2_booking_id' => $trip2_booking_id,
            'trip3_booking_id' => $trip3_booking_id
        ]);

        try {
            // Call the method in BookingController that handles API calls
            // NOTE: All API calls are commented out in this method
            app('App\Http\Controllers\BookingController')->handleFerryBookingAPIs(
                $booking_id, 
                $trip2_booking_id, 
                $trip3_booking_id
            );
            
            // Send notification emails
            $this->sendFerryBookingEmails(
                $booking_id, 
                $trip2_booking_id, 
                $trip3_booking_id, 
                $metadata['user_email'] ?? null
            );
            
            \Log::info('Ferry booking processing completed successfully');
            
        } catch (\Exception $e) {
            \Log::error('Ferry API handling failed', [
                'booking_id' => $booking_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Send ferry booking notification emails
     * Email will inform customer that booking is confirmed and team will contact them
     */
    private function sendFerryBookingEmails($booking_id, $trip2_booking_id, $trip3_booking_id, $user_email)
    {
        if (!$user_email) {
            $booking = DB::table('booking')->where('id', $booking_id)->first();
            $user_email = $booking->c_email ?? null;
        }

        if (!$user_email) {
            \Log::warning('No email address found for booking', ['booking_id' => $booking_id]);
            return;
        }

        $results = DB::table('booking')->where('id', $booking_id)->first();
        
        $shipNameArray = ['Green Ocean 1', 'Green Ocean 2', 'ITT Majestic', 'Makruzz', 'Nautika'];
        
        $bookingId1 = in_array($results->ship_name, $shipNameArray) ? $booking_id : NULL;
        $bookingId2 = NULL;
        $bookingId3 = NULL;
        
        if ($trip2_booking_id) {
            $results2 = DB::table('booking')->where('id', $trip2_booking_id)->first();
            $bookingId2 = ($results2 && in_array($results2->ship_name, $shipNameArray)) ? $trip2_booking_id : NULL;
        }
        
        if ($trip3_booking_id) {
            $results3 = DB::table('booking')->where('id', $trip3_booking_id)->first();
            $bookingId3 = ($results3 && in_array($results3->ship_name, $shipNameArray)) ? $trip3_booking_id : NULL;
        }
        
        try {
            // Send customer email
            $customerEmailSent = PHPMailerHelper::sendBookingConfirmationEmail(
                $user_email, 
                $bookingId1, 
                $bookingId2, 
                $bookingId3, 
                ''
            );
            
            // Send admin email
            $adminEmailSent = PHPMailerHelper::sendBookingConfirmationEmail(
                'andamanferrybookings@gmail.com', 
                $booking_id, 
                $trip2_booking_id, 
                $trip3_booking_id, 
                'Hello Admin'
            );
            
            if ($customerEmailSent && $adminEmailSent) {
                \Log::info('Ferry booking emails sent successfully', [
                    'customer_email' => $user_email,
                    'booking_ids' => [$bookingId1, $bookingId2, $bookingId3]
                ]);
            } else {
                \Log::error('Failed to send ferry booking emails', [
                    'customer_email_sent' => $customerEmailSent,
                    'admin_email_sent' => $adminEmailSent,
                    'customer_email' => $user_email
                ]);
            }
            
        } catch (\Exception $e) {
            \Log::error('Email sending error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Handle PhonePe Webhook (Backup handler)
     */
    public function handleWebhook(Request $request)
    {
        try {
            \Log::info('PhonePe Webhook Received', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            $headers = getallheaders();
            $requestBody = file_get_contents('php://input');
            
            $callbackResponse = $this->phonePeClient->verifyCallbackResponse(
                $headers,
                json_decode($requestBody, true),
                $this->webhookUsername,
                $this->webhookPassword
            );

            $type = $callbackResponse->getType();
            $payload = $callbackResponse->getPayload();
            $merchantOrderId = $payload->getOriginalMerchantOrderId();

            \Log::info('Verified Webhook', [
                'type' => $type,
                'merchant_order_id' => $merchantOrderId
            ]);

            if ($type === 'CHECKOUT_ORDER_COMPLETED') {
                DB::table('booking')
                    ->where('phonepe_transaction_id', $merchantOrderId)
                    ->update([
                        'payment_status' => 'success',
                        'updated_at' => Carbon::now()
                    ]);
            } 
            elseif ($type === 'CHECKOUT_ORDER_FAILED') {
                DB::table('booking')
                    ->where('phonepe_transaction_id', $merchantOrderId)
                    ->update([
                        'payment_status' => 'failed',
                        'updated_at' => Carbon::now()
                    ]);
            }

            return response()->json(['status' => 'success'], 200);

        } catch (PhonePeException $e) {
            $this->handlePhonePeException($e, [
                'operation' => 'handleWebhook',
                'ip' => $request->ip()
            ]);
            return response()->json(['error' => 'Verification failed'], 400);
            
        } catch (\Exception $e) {
            \Log::error('Webhook Processing Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Internal error'], 500);
        }
    }

    /**
     * Success page
     */
    public function success($transaction_id = null)
    {
        if (!$transaction_id) {
            return redirect()->route('home')->with('error', 'Invalid transaction');
        }

        $booking = DB::table('booking')
            ->where('phonepe_transaction_id', $transaction_id)
            ->first();

        if (!$booking) {
            \Log::error('Success: Booking not found', ['transaction_id' => $transaction_id]);
            
            $data = [
                'transaction_id' => $transaction_id,
                'order_id' => $transaction_id,
                'booking_id' => null,
                'trip2_booking_id' => null,
                'trip3_booking_id' => null,
            ];
            
            return view('phonepe.success', $data);
        }

        $trip2_booking_id = null;
        $trip3_booking_id = null;
        
        if ($booking->type == 'ferry') {
            $relatedBookings = DB::table('booking')
                ->where('phonepe_transaction_id', $transaction_id)
                ->where('id', '!=', $booking->id)
                ->get();
                
            foreach ($relatedBookings as $related) {
                if ($related->trip_type == 'Trip 2') {
                    $trip2_booking_id = $related->id;
                } elseif ($related->trip_type == 'Trip 3') {
                    $trip3_booking_id = $related->id;
                }
            }
        }

        \Log::info('Success page shown', [
            'booking_id' => $booking->id,
            'trip2_booking_id' => $trip2_booking_id,
            'trip3_booking_id' => $trip3_booking_id
        ]);

        $data = [
            'transaction_id' => $transaction_id,
            'order_id' => $transaction_id,
            'booking_id' => $booking->id,
            'booking' => $booking,
            'trip2_booking_id' => $trip2_booking_id,
            'trip3_booking_id' => $trip3_booking_id,
        ];

        // Clear session data
        Session::forget(['booking_id', 'trip2_booking_id', 'trip3_booking_id', 
                        'phonepe_transaction_id', 'booking_type', 'total_amount', 
                        'trip_data', 'user_phone', 'user_email', 'user_name',
                        'ferry_list', 'booking_data', 'trip_type']);

        return view('phonepe.success', $data);
    }

    /**
     * Failed page
     */
    public function failed($transaction_id)
    {
        $booking = DB::table('booking')
            ->where('phonepe_transaction_id', $transaction_id)
            ->first();
    
        $data = [
            'transaction_id' => $transaction_id,
            'booking' => $booking,
        ];
    
        return view('phonepe.failed', $data);
    }
    
    /**
     * Pending page
     */
    public function pending($transaction_id)
    {
        $booking = DB::table('booking')
            ->where('phonepe_transaction_id', $transaction_id)
            ->first();
    
        $data = [
            'transaction_id' => $transaction_id,
            'booking' => $booking,
        ];
    
        return view('phonepe.pending', $data);
    }
    
    /**
     * Send email for a specific booking
     */
    private function sendEmailForBooking($booking_id)
    {
        try {
            $booking = DB::table('booking')->where('id', $booking_id)->first();
            
            if (!$booking) {
                \Log::error('Booking not found for email', ['booking_id' => $booking_id]);
                return false;
            }
            
            // Get related bookings for ferry trips
            $trip2_booking_id = null;
            $trip3_booking_id = null;
            
            if ($booking->type == 'ferry') {
                $relatedBookings = DB::table('booking')
                    ->where('phonepe_transaction_id', $booking->phonepe_transaction_id)
                    ->where('id', '!=', $booking_id)
                    ->get();
                    
                foreach ($relatedBookings as $related) {
                    if ($related->trip_type == 'Trip 2') {
                        $trip2_booking_id = $related->id;
                    } elseif ($related->trip_type == 'Trip 3') {
                        $trip3_booking_id = $related->id;
                    }
                }
            }
            
            // Send customer email
            $customerEmailSent = PHPMailerHelper::sendBookingConfirmationEmail(
                $booking->c_email,
                $booking_id,
                $trip2_booking_id,
                $trip3_booking_id,
                ''
            );
            
            // Send admin email
            $adminEmailSent = PHPMailerHelper::sendBookingConfirmationEmail(
                'andamanferrybookings@gmail.com',
                $booking_id,
                $trip2_booking_id,
                $trip3_booking_id,
                'Hello Admin'
            );
            
            if ($customerEmailSent && $adminEmailSent) {
                \Log::info('Booking confirmation emails sent successfully', [
                    'booking_id' => $booking_id,
                    'customer_email' => $booking->c_email
                ]);
                return true;
            } else {
                \Log::error('Failed to send booking confirmation emails', [
                    'booking_id' => $booking_id,
                    'customer_email_sent' => $customerEmailSent,
                    'admin_email_sent' => $adminEmailSent
                ]);
                return false;
            }
            
        } catch (\Exception $e) {
            \Log::error('Error sending booking email', [
                'booking_id' => $booking_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}