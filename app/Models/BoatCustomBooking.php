<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoatCustomBooking extends Model
{
    protected $table = 'boat_custom_booking';

    protected $fillable = [
        'name',
        'price',
        'status',
    ];
} 