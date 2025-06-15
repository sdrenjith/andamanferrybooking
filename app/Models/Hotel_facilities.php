<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_facilities extends Model
{
    use HasFactory;
    protected $table = 'hotel_facilities';

    protected $fillable = [
        'hotel_id',
        'meal_price',
        'flower_bed_price',
        'candle_light_dinner_price',
        'created_by',
       
    ];
}
