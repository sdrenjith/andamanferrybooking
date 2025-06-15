<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;
    protected $table = 'itinerarys';
    public $timestamps = false;
    protected $fillable = [
        'location_id', 'package_id','sightseeing_id', 'itinerary_day', 'title', 'subtitle'
    ];

    public function sightseeingmodel()
    {
        return $this->belongsTo(Sightseeing::class, 'sightseeing_id');
    }
    public function hotels()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
    
}

