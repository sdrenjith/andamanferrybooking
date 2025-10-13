<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatSchedule extends Model
{
    protected $table = 'boat_schedule';

    protected $fillable = [
        'title',
        'image',
        'from_date',
        'to_date',
        'price',
        'status',
        'created_at',
        'updated_at',
        'description'
    ];


}
