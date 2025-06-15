<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sightseeing extends Model
{
    use HasFactory;
    protected $table = 'sight_seeings';
    protected $fillable = [
        'sightseeing_location','title', 'subtitle', 'location_id','status', 'delete'
    ];

    public function sight_images()
    {
        // return $this->belongsTo(Activity_images::class, 'parent_id');
        return $this->hasMany(Sightseeing_images::class, 'parent_id', 'id');
    }
    public function sight_locations()
    {
         return $this->hasMany(Sightseeing_location::class, 'sightseeing_id');
        //return $this->hasMany(Sightseeing_location::class, 'parent_id', 'id');
    }
    
}
