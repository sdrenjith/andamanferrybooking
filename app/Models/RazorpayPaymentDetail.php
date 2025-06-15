<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorpayPaymentDetail extends Model
{
    use HasFactory;
    protected $table = 'razorpay_payment_details';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'order_id', 'payment_id', 'amount', 'currency', 'status', 'invoice_id',
        'international', 'method', 'amount_refunded', 'refund_status', 'captured', 'description',
        'card_id', 'bank', 'wallet', 'vpa', 'email', 'contact', 'address', 'fee', 'tax',
        'error_code', 'error_description', 'error_source', 'error_step', 'error_reason', 'created_at'
    ];
}
