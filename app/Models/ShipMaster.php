<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipMaster extends Model
{
    use HasFactory;
    protected $table = 'ship_master';
    protected $fillable = [
        'ship_master','title','image','status','created_at','updated_at',
    ];

    public function images()
    {
        return $this->hasMany(ShipImages::class, 'ship_id', 'id'); 
    }
}
