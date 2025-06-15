<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipClass extends Model
{
    use HasFactory;

    protected $table = 'ship_classes';

    protected $fillable = [
        'title'
    ];
}
