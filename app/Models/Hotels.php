<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;
    protected $table = 'hotels';

    protected $fillable = [
        'location_id',
        'title',
        'subtitle',
        'status',
        'delete',
        'created_by',
    ];

    public function hotel_price(){
        return $this->hasOne(Hotel_price::class, 'hotel_id');
    }
    public function hotel_category(){
        return $this->hasMany(Hotel_category::class, 'id');
    }
    public function hotel_facilities(){
        return $this->hasMany(Hotel_facilities::class, 'hotel_id');
    }

    public function hotel_images()
    {
        // return $this->belongsTo(Activity_images::class, 'parent_id');
        return $this->hasMany(Hotel_images::class, 'parent_id', 'id');
    }
    public function hotel_facility()
    {
         //return $this->belongsTo(Hotel_facilities::class, 'id');
        return $this->hasOne(Hotel_facilities::class, 'hotel_id', 'id');
    }
  

}
