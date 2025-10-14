<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return "Cache cleared successfully";
});

Route::get('/env-test', function () {
    echo 'hi';
    return env('RAZOR_KEY_ID');
});

Route::middleware(['web'])->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/api/google-reviews', [App\Http\Controllers\GoogleReviewsController::class, 'getGoogleReviews']);
Route::get('/api/proxy-image', [App\Http\Controllers\ImageProxyController::class, 'proxyImage']);
    Route::get('/home_achievements', [App\Http\Controllers\HomeController::class, 'home_achievements']);
    Route::get('/home_banners', [App\Http\Controllers\HomeController::class, 'home_banners']);
    Route::get('/ferry-schedule', [App\Http\Controllers\HomeController::class, 'ferry_schedule']);

// Chatbot routes
Route::post('/api/chatbot/chat', [App\Http\Controllers\ChatbotController::class, 'chat']);
Route::get('/api/chatbot/initial', [App\Http\Controllers\ChatbotController::class, 'getInitialMessage']);

    Route::get('/testimonials', [App\Http\Controllers\TestimonialsController::class, 'index']);
    Route::get('/home_testimonials', [App\Http\Controllers\TestimonialsController::class, 'home_testimonials']);

    Route::get('/sightseeing', [App\Http\Controllers\SightseeingController::class, 'index']);
    Route::get('/sightseeing/{id}', [App\Http\Controllers\SightseeingController::class, 'detail']);

    Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index']);
    Route::get('/blog_list', [App\Http\Controllers\BlogController::class, 'list']);
    Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'detail']);

    Route::get('/activity', [App\Http\Controllers\ActivityController::class, 'index'])->name('activity');
    Route::get('/activity/{id}', [App\Http\Controllers\ActivityController::class, 'detail']);
    Route::get('/home_activity', [App\Http\Controllers\ActivityController::class, 'home_activity']);


    Route::get('/contact-us', [App\Http\Controllers\ContactusController::class, 'index']);
    Route::post('/contact-us-save', [App\Http\Controllers\ContactusController::class, 'save']);
    Route::get('/book_a_call', [App\Http\Controllers\ContactusController::class, 'book_a_call']);

    Route::get('/destination', [App\Http\Controllers\DestinationController::class, 'index']);
    Route::get('/destination/{id}', [App\Http\Controllers\DestinationController::class, 'detail']);
    Route::get('/home_destination', [App\Http\Controllers\DestinationController::class, 'home_destination']);
    Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index']);

    Route::get('/termsconditions', [App\Http\Controllers\TermsconditionsController::class, 'index']);
    Route::get('/cancellations', [App\Http\Controllers\TermsconditionsController::class, 'cancellations'])->name('cancellations');

    Route::get('/package', [App\Http\Controllers\PackageController::class, 'index'])->name('package');
    Route::get('/package/{id}', [App\Http\Controllers\PackageController::class, 'detail']);

    Route::post('/select_sightseeing', [App\Http\Controllers\PackageController::class, 'itinerary_sightseeing_location'])->name('select_sightseeing');
    Route::get('/location_wise_hotel_dropdown', [App\Http\Controllers\PackageController::class, 'itinerary_hotel'])->name('location_wise_hotel_dropdown');
    Route::get('/change_hotel', [App\Http\Controllers\PackageController::class, 'change_hotel_select_wise'])->name('change_hotel');

    Route::get('/location_wise_activity_dropdown', [App\Http\Controllers\PackageController::class, 'itinerary_activity'])->name('location_wise_activity_dropdown');
    Route::get('/change_activity', [App\Http\Controllers\PackageController::class, 'change_activity_select_wise'])->name('change_activity');
    // Route::get('/enquery', [App\Http\Controllers\EnqueryController::class, 'index']);
    // Route::post('/create_enquery', [App\Http\Controllers\EnqueryController::class, 'create']);

    Route::resource('enquery', App\Http\Controllers\EnqueryController::class);

    Route::get('/captcha', [App\Http\Controllers\EnqueryController::class, 'captcha'])->name('captcha');
    Route::get('/load_more', [App\Http\Controllers\BlogController::class, 'load_more'])->name('load_more');

    Route::get('/home_package', [App\Http\Controllers\PackageController::class, 'home_package'])->name('home_package');

    Route::get('/change_car', [App\Http\Controllers\PackageController::class, 'change_car_select_wise'])->name('change_car');
    Route::get('/create_custom_package', [App\Http\Controllers\PackageController::class, 'create_custom_package'])->name('create_custom_package');
    Route::get('/new_booking', [App\Http\Controllers\PackageController::class, 'new_booking'])->name('new_booking');
    Route::post('/booking_details', [App\Http\Controllers\PackageController::class, 'booking_details'])->name('booking_details');

    Route::get('razorpay-payment/{id}/{package_booking_details_id}', [App\Http\Controllers\RazorpayController::class, 'payment'])->name('razorpay.payment');
    Route::post('razorpay-payment', [App\Http\Controllers\RazorpayController::class, 'store'])->name('razorpay.payment.store');
    //Route::get('payment_success', [App\Http\Controllers\RazorpayController::class, 'payment_success'])->name('payment_success');

    Route::get('pdf', [App\Http\Controllers\PackageController::class, 'pdf'])->name('pdf');

    Route::get('user_register', [App\Http\Controllers\PackageController::class, 'user_register'])->name('user_register');

    // Route::get('logout', [App\Http\Controllers\PackageController::class, 'logout'])->name('logout');
    Route::GET('verify_otp', [App\Http\Controllers\PackageController::class, 'verify_otp'])->name('verify_otp');


    Route::GET('set_session', [App\Http\Controllers\TestContrller::class, 'set_session'])->name('set_session');
    Route::GET('get_session', [App\Http\Controllers\TestContrller::class, 'get_session'])->name('get_session');


    Route::get('/ferry-booking', [App\Http\Controllers\FerrybookingController::class, 'ferry_booking'])->name('ferry-booking');

    Route::get('/search-result-ferry', [App\Http\Controllers\FerrybookingController::class, 'ferry_booking_search'])->name('search-result-ferry');


    Route::get('/boat-list',[App\Http\Controllers\BoatbookingController::class,'boat_booking'])->name('boat_booking');
    Route::get('/load_more', [App\Http\Controllers\BlogController::class, 'load_more'])->name('load_more');

    Route::get('/search-result-boat', [App\Http\Controllers\BoatbookingController::class, 'boat_booking_search'])->name('search-result-boat');


    Route::Post('/login-check',[App\Http\Controllers\HomeController::class,'login_check'])->name('login-check');
    
    Route::post('/get-login-otp',[App\Http\Controllers\HomeController::class,'get_login_otp'])->name('get-login-otp');

 
    Route::post('/login-by-otp', [App\Http\Controllers\HomeController::class,'login_by_otp'])->name('login-by-otp');

    Route::get('/booking_boat',[App\Http\Controllers\BookingController::class,'booking_show_boat'])->name('booking_boat_search');

    Route::post('/booking_form_boat', [App\Http\Controllers\BookingController::class, 'boat_booking']);


    Route::match(['get', 'post'], '/booking-ferry', [App\Http\Controllers\BookingController::class,'booking_show_ferry'])->name('booking-ferry');

    Route::post('/booking-form-ferry',[App\Http\Controllers\BookingController::class,'ferry_booking'])->name('booking-form-ferry');

    // Route::get('/payment-initiate',[App\Http\controllers\BookingController::class,'payment_initiate'])->name('payment-initiate');
    Route::post('/payment-response/{order_id}',[App\Http\Controllers\BookingController::class,'payment_response'])->name('payment-response');
    Route::post('/ticket_generate', [App\Http\Controllers\BookingController::class, 'ticket_generate'])->name('ticket_generate');

    Route::get('user_register', [App\Http\Controllers\HomeController::class, 'user_register'])->name('user_register');
    Route::GET('verify_otp', [App\Http\Controllers\HomeController::class, 'verify_otp'])->name('verify_otp');

    Route::get('/ticket-cancellation-request',[App\Http\Controllers\OrderCancellationController::class,'ticket_cencel_request'])->name('ticket-cancellation-route');
    Route::post('/ticket-cancellation-preview',[App\Http\Controllers\OrderCancellationController::class,'ticket_cencel_preview']);
    Route::post('/ticket-cenceled-details-ferry',[App\Http\Controllers\OrderCancellationController::class,'ticket_cencel_details_ferry'])->name('booking-cenceled-ferry');
    Route::post('/ticket-cenceled-details-boat',[App\Http\Controllers\OrderCancellationController::class,'ticket_cencel_details_boat'])->name('booking-cenceled-boat');

    // Route::post('/login-check',[App\Http\Controllers\HomeController::class,'login_check'])->name('login-check');
    Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

    Route::get('/about',[App\Http\Controllers\HomeController::class,'about']);
    Route::get('/terms-and-conditions',[App\Http\Controllers\HomeController::class,'terms_and_conditions']);    
    Route::get('/privacy-policy',[App\Http\Controllers\HomeController::class,'privacy_policy']);
    Route::get('/cancellation-refund',[App\Http\Controllers\HomeController::class,'cancellation_refund']);
    Route::get('/send-email',[App\Http\Controllers\BookingController::class,'send_email']);
    Route::post('/booking-data-store',[App\Http\Controllers\FerrybookingController::class,'bookingDataStoreSession']);
    Route::post('/booking-seat-data-store-session',[App\Http\Controllers\FerrybookingController::class,'bookingSeatDataStoreSession']);
    Route::post('/get-nautika-layout',[App\Http\Controllers\FerrybookingController::class,'getNautikaLayout']);

    Route::post('/get-green-ship-layout',[App\Http\Controllers\FerrybookingController::class,'getGreenShipLayout']);

    Route::Post('/store_selected_seats', [App\Http\Controllers\BookingController::class,'store_selected_seats']);

    // Route::get('/send-email', function () {
    //     return view('emails.test');
    // });
    // Route::get('/send-admin', function () {
    //     return view('emails.mail_admin');
    // });

    // Green Ocean test route
    Route::get('/payment-mail/{pnr}',[App\Http\Controllers\BookingController::class,'sendMailGreenOcean'])->name('payment-mail');
    Route::get('/test-green-api-call/{pnr}',[App\Http\Controllers\BookingController::class,'TestGreenOceanAPICall']);

    Route::get('/boat-booking', [App\Http\Controllers\BoatbookingController::class, 'boatBookingPage'])->name('boat_booking_page');

    Route::post('/booking-form-boat-payment', [App\Http\Controllers\BookingController::class, 'boat_booking_payment'])->name('booking-form-boat-payment');

    Route::match(['get', 'post'], '/booking-boat', [App\Http\Controllers\BookingController::class, 'booking_show_boat_summary'])->name('booking-boat');

    Route::post('/ajax/boat-booking', [App\Http\Controllers\BookingController::class, 'ajaxBoatBooking']);
    Route::get('/boat-payment/{order_id}', [App\Http\Controllers\BookingController::class, 'boatPaymentPage']);

    Route::post('/payment-failed/{order_id}', [App\Http\Controllers\BookingController::class, 'paymentFailed']);

    Route::get('/boat-booking/invoice/{order_id}', [App\Http\Controllers\BookingController::class, 'boatBookingInvoice'])->name('boat-booking.invoice');
    Route::get('/boat-booking/invoice-pdf/{order_id}', [App\Http\Controllers\BookingController::class, 'boatBookingInvoicePdf'])->name('boat-booking.invoice-pdf');
    Route::get('/ferry-booking/success/{order_id}', [App\Http\Controllers\BookingController::class, 'ferryBookingSuccess'])->name('ferry-booking.success');
    Route::get('/boat-booking/success/{order_id}', [App\Http\Controllers\BookingController::class, 'boatPaymentSuccess'])->name('boat-payment-success');
    Route::get('/boat-booking/cancel/{order_id}', [App\Http\Controllers\BookingController::class, 'boatPaymentCancel'])->name('boat-payment-cancel');
});

// Handle razorpay webhook
Route::post('/validate-payment', [App\Http\Controllers\RazorpayWebhookController::class, 'handleWebhook']);

// PhonePe payment routes
Route::match(['get', 'post'], '/phonepe/initiate-boat-payment', [App\Http\Controllers\PhonePeController::class, 'initiateBoatPayment'])->name('phonepe.boat.initiate');
Route::match(['get', 'post'], '/phonepe/initiate-ferry-payment', [App\Http\Controllers\PhonePeController::class, 'initiateFerryPayment'])->name('phonepe.ferry.initiate');

// PhonePe Webhook & Callback Routes
Route::post('/phonepe/webhook', [App\Http\Controllers\PhonePeController::class, 'handleWebhook'])->name('phonepe.webhook');
Route::any('/phonepe/callback', [App\Http\Controllers\PhonePeController::class, 'handleCallback'])->name('phonepe.callback');

// PhonePe Status Pages
Route::get('/phonepe/success/{transaction_id?}', [App\Http\Controllers\PhonePeController::class, 'success'])->name('phonepe.success');
Route::get('/phonepe/failed/{transaction_id}', [App\Http\Controllers\PhonePeController::class, 'failed'])->name('phonepe.failed');
Route::get('/phonepe/pending/{transaction_id}', [App\Http\Controllers\PhonePeController::class, 'pending'])->name('phonepe.pending');

// Test email route
Route::get('/test-email', function() {
    try {
        $result = \App\Helpers\PHPMailerHelper::sendBookingConfirmationEmail(
            'test@example.com', // Replace with your email for testing
            1, // Replace with actual booking ID
            null,
            null,
            ''
        );
        
        if ($result) {
            return 'Email sent successfully!';
        } else {
            return 'Email failed to send.';
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Simple email test
Route::get('/test-simple-email', function() {
    $test_email = 'your-email@example.com'; // Change this to your email
    $subject = 'Test Email from Andaman Ferry Booking';
    $message = 'This is a simple test email to verify PHP mail function is working.';
    $headers = 'From: andamanferrybookings@gmail.com';
    
    $result = mail($test_email, $subject, $message, $headers);
    
    return [
        'email_sent' => $result ? 'Success' : 'Failed',
        'php_mail_available' => function_exists('mail') ? 'Yes' : 'No',
        'test_email' => $test_email,
        'server_info' => [
            'server_name' => $_SERVER['SERVER_NAME'] ?? 'Unknown',
            'php_version' => phpversion(),
            'last_error' => error_get_last()
        ]
    ];
});

// Test server detection
Route::get('/test-server-detection', function() {
    $serverName = $_SERVER['SERVER_NAME'] ?? $_SERVER['HTTP_HOST'] ?? 'localhost';
    $isLocalhost = in_array($serverName, ['localhost', '127.0.0.1', '::1']) || 
                  strpos($serverName, 'localhost') !== false ||
                  strpos($serverName, '127.0.0.1') !== false ||
                  strpos($serverName, 'xampp') !== false;
    
    return [
        'server_name' => $serverName,
        'is_localhost' => $isLocalhost,
        'server_vars' => [
            'SERVER_NAME' => $_SERVER['SERVER_NAME'] ?? 'not set',
            'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'not set',
            'SERVER_ADDR' => $_SERVER['SERVER_ADDR'] ?? 'not set'
        ],
        'detection_logic' => [
            'localhost_check' => in_array($serverName, ['localhost', '127.0.0.1', '::1']),
            'contains_localhost' => strpos($serverName, 'localhost') !== false,
            'contains_127' => strpos($serverName, '127.0.0.1') !== false,
            'contains_xampp' => strpos($serverName, 'xampp') !== false
        ]
    ];
});

// View saved emails (for localhost testing)
Route::get('/view-emails', function() {
    $emailDir = storage_path('logs/emails');
    
    if (!is_dir($emailDir)) {
        return 'No emails directory found. Emails will be created when you test the email functionality.';
    }
    
    $files = glob($emailDir . '/*.html');
    
    if (empty($files)) {
        return 'No email files found. Try sending an email first.';
    }
    
    $emailList = [];
    foreach ($files as $file) {
        $emailList[] = [
            'filename' => basename($file),
            'size' => filesize($file),
            'modified' => date('Y-m-d H:i:s', filemtime($file)),
            'url' => '/view-email/' . basename($file)
        ];
    }
    
    return view('emails.list', ['emails' => $emailList]);
});

// View specific email file
Route::get('/view-email/{filename}', function($filename) {
    $emailFile = storage_path('logs/emails/' . $filename);
    
    if (!file_exists($emailFile)) {
        return 'Email file not found.';
    }
    
    $content = file_get_contents($emailFile);
    
    return '<pre>' . htmlspecialchars($content) . '</pre>';
});

// Manual email sending for specific booking
Route::get('/send-booking-email/{booking_id}', function($booking_id) {
    try {
        $controller = new \App\Http\Controllers\PhonePeController();
        $reflection = new ReflectionClass($controller);
        $method = $reflection->getMethod('sendEmailForBooking');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $booking_id);
        
        if ($result) {
            return "Email sent successfully for booking ID: {$booking_id}";
        } else {
            return "Failed to send email for booking ID: {$booking_id}";
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Direct email sending for specific booking (production ready)
Route::get('/send-direct-email/{booking_id}', function($booking_id) {
    try {
        // Get booking details
        $booking = DB::table('booking')->where('id', $booking_id)->first();
        
        if (!$booking) {
            return "Booking ID {$booking_id} not found.";
        }
        
        // Get passenger details
        $passengerDetails = DB::table('booking_passenger_details')
            ->where('booking_id', $booking_id)
            ->get();
        
        // Send email directly
        $result = \App\Helpers\PHPMailerHelper::sendBookingConfirmationEmail(
            $booking->c_email,
            $booking_id,
            null,
            null,
            ''
        );
        
        if ($result) {
            return "Email sent successfully to {$booking->c_email} for booking ID: {$booking_id}";
        } else {
            return "Failed to send email to {$booking->c_email} for booking ID: {$booking_id}";
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Send email for most recent booking
Route::get('/send-latest-booking-email', function() {
    try {
        $latestBooking = DB::table('booking')
            ->where('payment_status', 'success')
            ->orderBy('id', 'desc')
            ->first();
            
        if (!$latestBooking) {
            return 'No successful bookings found.';
        }
        
        $controller = new \App\Http\Controllers\PhonePeController();
        $reflection = new ReflectionClass($controller);
        $method = $reflection->getMethod('sendEmailForBooking');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $latestBooking->id);
        
        if ($result) {
            return "Email sent successfully for latest booking ID: {$latestBooking->id} (Customer: {$latestBooking->c_email})";
        } else {
            return "Failed to send email for latest booking ID: {$latestBooking->id}";
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Force localhost mode for testing
Route::get('/force-localhost-email/{booking_id}', function($booking_id) {
    try {
        // Set environment variable to force localhost mode
        putenv('FORCE_LOCALHOST_EMAIL=true');
        
        $result = \App\Helpers\PHPMailerHelper::sendBookingConfirmationEmail(
            'test@example.com', // Change this to your email
            $booking_id,
            null,
            null,
            ''
        );
        
        if ($result) {
            return "Email saved to file successfully for booking ID: {$booking_id}";
        } else {
            return "Failed to save email for booking ID: {$booking_id}";
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Production email test
Route::get('/test-production-email', function() {
    try {
        $test_email = 'your-email@example.com'; // Change this to your email
        $subject = 'Test Production Email - Andaman Ferry Booking';
        $message = '
        <html>
        <body>
            <h2>Test Email from Andaman Ferry Booking</h2>
            <p>This is a test email to verify PHP mail function is working on production server.</p>
            <p><strong>Server Info:</strong></p>
            <ul>
                <li>Server: ' . ($_SERVER['SERVER_NAME'] ?? 'Unknown') . '</li>
                <li>PHP Version: ' . phpversion() . '</li>
                <li>Time: ' . date('Y-m-d H:i:s') . '</li>
            </ul>
        </body>
        </html>';
        
        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: Andaman Ferry Booking <andamanferrybookings@gmail.com>',
            'Reply-To: andamanferrybookings@gmail.com',
            'Return-Path: andamanferrybookings@gmail.com',
            'X-Mailer: PHP/' . phpversion()
        ];
        
        $result = mail($test_email, $subject, $message, implode("\r\n", $headers));
        
        return [
            'email_sent' => $result ? 'Success' : 'Failed',
            'test_email' => $test_email,
            'server_info' => [
                'server_name' => $_SERVER['SERVER_NAME'] ?? 'Unknown',
                'http_host' => $_SERVER['HTTP_HOST'] ?? 'Unknown',
                'server_addr' => $_SERVER['SERVER_ADDR'] ?? 'Unknown',
                'php_version' => phpversion(),
                'mail_function' => function_exists('mail') ? 'Available' : 'Not available',
                'last_error' => error_get_last()
            ]
        ];
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Debug email sending for specific booking
Route::get('/debug-email/{booking_id}', function($booking_id) {
    try {
        // Get booking details
        $booking = DB::table('booking')->where('id', $booking_id)->first();
        
        if (!$booking) {
            return "Booking ID {$booking_id} not found.";
        }
        
        // Get passenger details
        $passengerDetails = DB::table('booking_passenger_details')
            ->where('booking_id', $booking_id)
            ->get();
            
        $debug_info = [
            'booking_id' => $booking_id,
            'booking_found' => $booking ? 'Yes' : 'No',
            'customer_email' => $booking->c_email ?? 'Not set',
            'customer_name' => $booking->c_name ?? 'Not set',
            'passenger_count' => $passengerDetails->count(),
            'booking_type' => $booking->type ?? 'Not set',
            'payment_status' => $booking->payment_status ?? 'Not set',
            'amount' => $booking->amount ?? 'Not set'
        ];
        
        // Test simple email first
        $test_email = 'test@example.com'; // Change this to your email
        $simple_subject = 'Test Email from Andaman Ferry Booking';
        $simple_message = 'This is a test email to verify PHP mailer is working.';
        $simple_headers = 'From: andamanferrybookings@gmail.com';
        
        $simple_result = mail($test_email, $simple_subject, $simple_message, $simple_headers);
        
        $debug_info['simple_email_test'] = $simple_result ? 'Success' : 'Failed';
        $debug_info['php_mail_function'] = function_exists('mail') ? 'Available' : 'Not available';
        $debug_info['server_name'] = $_SERVER['SERVER_NAME'] ?? 'Unknown';
        
        return '<pre>' . print_r($debug_info, true) . '</pre>';
        
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage() . '<br>Trace: ' . $e->getTraceAsString();
    }
});

// Test email for specific booking (production ready)
Route::get('/test-email-booking/{booking_id}', function($booking_id) {
    try {
        $booking = DB::table('booking')->where('id', $booking_id)->first();
        
        if (!$booking) {
            return "Booking ID {$booking_id} not found.";
        }
        
        // Send email using PHPMailerHelper directly
        $result = \App\Helpers\PHPMailerHelper::sendBookingConfirmationEmail(
            $booking->c_email,
            $booking_id,
            null,
            null,
            ''
        );
        
        if ($result) {
            return "✅ Email sent successfully to {$booking->c_email} for booking ID: {$booking_id}";
        } else {
            return "❌ Failed to send email to {$booking->c_email} for booking ID: {$booking_id}";
        }
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});