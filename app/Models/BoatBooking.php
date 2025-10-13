<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatBooking extends Model
{
    use HasFactory;

    protected $table = 'boat_bookings';

    protected $fillable = [
        'boat',
        'travel_date',
        'no_of_passengers',
        'infants',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'payment_status',
        'age',
        'gender',
    ];
} 