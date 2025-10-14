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
                        'SERVER_NAME' => $_SERVER['SERVER_NAME'] ?? 'not set',
                        'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'not set',
                        'SERVER_ADDR' => $_SERVER['SERVER_ADDR'] ?? 'not set'
                    ]
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Email sending error', [
                'error' => $e->getMessage(),
                'booking_id' => $booking_id,
                'email' => $user_email
            ]);
            return false;
        }
    }

    /**
     * Generate email content
     */
    private static function generateEmailContent($booking, $passengerDetails, $trip2_booking_id = null, $trip3_booking_id = null, $greet = '')
    {
        // Get additional booking details if needed
        $trip2_booking = null;
        $trip3_booking = null;
        
        if ($trip2_booking_id) {
            $trip2_booking = DB::table('booking')->where('id', $trip2_booking_id)->first();
        }
        
        if ($trip3_booking_id) {
            $trip3_booking = DB::table('booking')->where('id', $trip3_booking_id)->first();
        }

        // Calculate total amount
        $total_amount = $booking->amount;
        if ($trip2_booking) $total_amount += $trip2_booking->amount;
        if ($trip3_booking) $total_amount += $trip3_booking->amount;

        // Generate location names
        $from_location = self::getLocationName($booking->from_location);
        $to_location = self::getLocationName($booking->to_location);

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Andaman Ferry Booking Confirmation</title>
            <meta charset="UTF-8">
        </head>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
                
                <!-- Header -->
                <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-bottom: 30px;">
                    <h1 style="color: #1592eb; font-size: 28px; margin: 10px 0;">Andaman Ferry Booking</h1>
                    <div style="margin: 10px 0;">
                        <img src="https://andamanferrybookings.com/assets/images/logo.png" style="width: 40px;" alt="Logo">
                    </div>
                    <div style="background: #44707e; color: #FFF; font-size: 18px; padding: 10px 20px; border-radius: 5px; display: inline-block;">
                        <strong>Payment Successful - Advance Booking Confirmed</strong>
                    </div>
                </div>

                <!-- Greeting -->
                <div style="margin-bottom: 30px;">
                    <h3>Hi ' . $booking->c_name . ',</h3>
                    <p style="font-size: 16px; margin: 10px 0;">Your advance booking payment has been received successfully!</p>
                    <p style="font-size: 16px; margin: 10px 0;">Our team will contact you shortly to confirm your ferry booking details.</p>
                </div>

                <!-- Booking Details -->
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                    <h3 style="color: #1592eb; margin-bottom: 15px;">Booking Details</h3>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Booking Reference:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">#' . $booking->order_id . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Booking Date:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">' . date('M d, Y', strtotime($booking->created_at)) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Ship:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">' . ucfirst($booking->ship_name) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Route:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $from_location . ' to ' . $to_location . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Journey Date:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">' . date('M d, Y', strtotime($booking->date_of_jurney)) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Passengers:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $booking->no_of_passenger . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Amount Paid:</strong></td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">₹' . number_format($total_amount, 2) . '</td>
                        </tr>
                    </table>
                </div>

                <!-- Passenger Details -->
                <div style="margin-bottom: 30px;">
                    <h3 style="color: #1592eb; margin-bottom: 15px;">Passenger Details</h3>
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                        <thead>
                            <tr style="background: #f8f9fa;">
                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Name</th>
                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Gender</th>
                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Age</th>
                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Contact</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($passengerDetails as $passenger) {
            $html .= '
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">' . $passenger->full_name . '</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">' . $passenger->gender . '</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">' . $passenger->dob . '</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">' . $booking->c_mobile . '</td>
                            </tr>';
        }

        $html .= '
                        </tbody>
                    </table>
                </div>

                <!-- Contact Information -->
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                    <h3 style="color: #1592eb; margin-bottom: 15px;">Contact Information</h3>
                    <p><strong>Email:</strong> andamanferrybookings@gmail.com</p>
                    <p><strong>Phone:</strong> 9933752444</p>
                    <p><strong>Website:</strong> www.andamanferrybookings.com</p>
                </div>

                <!-- Footer -->
                <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <p style="margin: 10px 0; font-size: 16px;">Thank you for choosing Andaman Ferry Booking!</p>
                    <p style="margin: 10px 0; color: #666;">For any queries, please contact our support team.</p>
                </div>

            </div>
        </body>
        </html>';

        return $html;
    }

    /**
     * Get location name from ID
     */
    private static function getLocationName($location_id)
    {
        switch ($location_id) {
            case 1:
                return 'Port Blair';
            case 2:
                return 'Swaraj Dweep (Havelock)';
            case 3:
                return 'Shaheed Dweep (Neil)';
            default:
                return 'Unknown';
        }
    }
}
