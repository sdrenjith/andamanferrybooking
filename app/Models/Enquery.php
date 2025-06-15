<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquery extends Model
{
    use HasFactory;
    protected $table = 'enquiries';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'travel_month',
        'travel_duration',
        'travel_person',
        'travel_starting_price',
        'travel_ending_price',
        'comments',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
        'status',
    ];
}
