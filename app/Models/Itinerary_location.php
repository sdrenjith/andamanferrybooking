<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary_location extends Model
{
    use HasFactory;
    protected $table = 'itinerary_location';

    protected $fillable = [
        'itinerary_id',
        'sightseeing_location_id',
        'type',
        'created_at',
       
    ];


    public function sightseeing_location(){
        return $this->hasMany(Sightseeing_location::class, 'id');
    }
}
