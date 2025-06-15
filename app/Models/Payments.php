<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'package_id',
        'payment_id',
        'payment_method',
        'package_booking_details_id',
        'currency',
        'amount',
        'order_id',
        'order_id',
        'card_type',
        'card_last4',
        'payment_status',
        'created_at',
    ];
}
