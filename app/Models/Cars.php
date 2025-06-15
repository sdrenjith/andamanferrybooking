<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $table="cars";
    protected $fillable =[
        'title',
        'car_category',
        'seater',
        'ac',
        'price_per_hour',
        'car_image',
        'status',
        
    ];
}
