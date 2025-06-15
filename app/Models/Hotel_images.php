<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_images extends Model
{
    use HasFactory;
    protected $table = 'hotel_images';
    public $timestamps = false;
    protected $fillable = [
        'path', 'parent_id','size'
    ];
}
