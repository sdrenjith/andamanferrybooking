<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerrySchedulePrice extends Model
{
    use HasFactory;
    protected $table = 'ferry_schedule_price';
    protected $fillable = [
        'schedule_id', 'class_id', 'price'
    ];

    public function schedule()
    {
        return $this->belongsTo(FerrySchedul::class, 'schedule_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(ShipClass::class, 'class_id', 'id');
    }
    
}
