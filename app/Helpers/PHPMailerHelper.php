<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PHPMailerHelper
{
    /**
     * Send booking confirmation email using PHP mailer
     */
    public static function sendBookingConfirmationEmail($user_email, $booking_id, $trip2_booking_id = null, $trip3_booking_id = null, $greet = '')
    {
        try {
            // Get booking details
            $booking = DB::table('booking')->where('id', $booking_id)->first();
            
            if (!$booking) {
                Log::error('Booking not found for email', ['booking_id' => $booking_id]);
                return false;
            }
            
            // Get passenger details
            $passengerDetails = DB::table('booking_passenger_details')
                ->where('booking_id', $booking_id)
                ->get();

            // Prepare email content
            $subject = 'Andaman Ferry Booking - Payment Successful';
            $message = self::generateEmailContent($booking, $passengerDetails, $trip2_booking_id, $trip3_booking_id, $greet);
            
            // Email headers for production
            $headers = [
                'MIME-Version: 1.0',
                'Content-type: text/html; charset=UTF-8',
                'From: Andaman Ferry Booking <andamanferrybookings@gmail.com>',
                'Reply-To: andamanferrybookings@gmail.com',
                'Return-Path: andamanferrybookings@gmail.com',
                'X-Mailer: PHP/' . phpversion(),
                'X-Priority: 3',
                'X-MSMail-Priority: Normal'
            ];

            // Log email attempt
            Log::info('Attempting to send booking confirmation email', [
                'email' => $user_email,
                'booking_id' => $booking_id,
                'subject' => $subject,
                'message_length' => strlen($message)
            ]);
            
            // Send email using PHP mail function
            $result = mail($user_email, $subject, $message, implode("\r\n", $headers));
            
            if ($result) {
                Log::info('Booking confirmation email sent successfully', [
                    'email' => $user_email,
                    'booking_id' => $booking_id
                ]);
                return true;
            } else {
                Log::error('Failed to send booking confirmation email', [
                    'email' => $user_email,
                    'booking_id' => $booking_id,
                    'subject' => $subject,
                    'headers' => implode("\r\n", $headers),
                    'php_mail_available' => function_exists('mail'),
                    'last_error' => error_get_last(),
                    'server_info' => [
                        'SERVER_NAME' => $_SERVER['SERVER_NAME'] ?? 'Unknown',
                        'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'Unknown',
                        'SERVER_ADDR' => $_SERVER['SERVER_ADDR'] ?? 'Unknown'
                    ]
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Email sending error', [
                'error' => $e->getMessage(),
                'booking_id' => $booking_id,
                'email' => $user_email,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Generate email content using Blade template
     */
    private static function generateEmailContent($booking, $passengerDetails, $trip2_booking_id = null, $trip3_booking_id = null, $greet = '')
    {
        // Use the Blade template instead of generating HTML directly
        $details = [
            'booking_id' => $booking->id,
            'trip2_booking_id' => $trip2_booking_id,
            'trip3_booking_id' => $trip3_booking_id,
            'greet' => $greet
        ];
        
        return view('emails.test', compact('booking', 'passengerDetails', 'trip2_booking_id', 'trip3_booking_id', 'greet', 'details'))->render();
    }
}