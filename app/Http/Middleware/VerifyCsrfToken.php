<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
       // 'get-login-otp',
        //'login-check',
        //'login-by-otp',
        'booking_form_boat',
        'payment-response/*',
        'booking-form-ferry',
        'booking-data-store',
        'phonepe/callback',
        'phonepe/success',
        'phonepe/success/*',
        'phonepe/failed',
        'phonepe/failed/*',
        'phonepe/pending/*',
        '/phonepe/webhook',
        
    ];
}
