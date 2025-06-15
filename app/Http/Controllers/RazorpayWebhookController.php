<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorpayWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
        $data = $request->getContent();
        $headers = $request->header();

        // Verify webhook signature
        $providedSignature = $headers['x-razorpay-signature'][0] ?? '';

        $generatedSignature = hash_hmac('sha256', $data, $webhookSecret);

        if (!hash_equals($providedSignature, $generatedSignature)) {
            Log::error("Razorpay Webhook Signature Mismatch");
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Decode the JSON payload
        $event = json_decode($data, true);
        Log::info("Razorpay Webhook Event Received", $event);

        switch ($event['event']) {
            case 'payment.authorized':
                $this->handlePaymentAuthorized($event);
                break;

            case 'payment.captured':
                $this->handlePaymentCaptured($event);
                break;

            case 'payment.failed':
                $this->handlePaymentFailed($event);
                break;
        }

        return response()->json(['message' => 'Webhook handled'], 200);
    }

    private function handlePaymentAuthorized($event)
    {
        $paymentId = $event['payload']['payment']['entity']['id'];
        $amount = $event['payload']['payment']['entity']['amount'];
        
        // TODO: Save payment as authorized in your database
        Log::info("Payment Authorized: ID - $paymentId, Amount - $amount");
    }

    private function handlePaymentCaptured($event)
    {
        $paymentId = $event['payload']['payment']['entity']['id'];

        // TODO: Update payment as captured in your database
        Log::info("Payment Captured: ID - $paymentId");
    }

    private function handlePaymentFailed($event)
    {
        $paymentId = $event['payload']['payment']['entity']['id'];

        // TODO: Update payment status as failed
        Log::error("Payment Failed: ID - $paymentId");
    }
}
