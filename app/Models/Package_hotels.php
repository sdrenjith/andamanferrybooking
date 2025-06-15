<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package_hotels extends Model
{
    use HasFactory;
    protected $table = 'package_hotels';

    protected $fillable = [
        'package_id',
        'location_id',
        'hotel_id',
        'status',
       
    ];
    public function hotels()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }
}
