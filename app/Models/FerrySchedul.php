<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerrySchedul extends Model
{
    use HasFactory;
    protected $table = 'ferry_schedule';
    protected $fillable = [
        'from_location','to_location','from_date','to_date','departure_time','arrival_time','ship_id','status','created_at','updated_at'
    ];


    public function ferryPrices()
    {
        return $this->hasMany(FerrySchedulePrice::class, 'schedule_id', 'id'); 
    }


    public function fromLocation()
    {
        return $this->belongsTo(FerryLocation::class, 'from_location', 'id');
    }

    public function toLocation()
    {
        return $this->belongsTo(FerryLocation::class, 'to_location', 'id');
    }

    public function ship()
    {
        return $this->belongsTo(ShipMaster::class, 'ship_id', 'id');
    }
}
