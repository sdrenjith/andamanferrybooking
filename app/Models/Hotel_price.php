<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_price extends Model
{
    use HasFactory;
    protected $table = 'hotel_price';
    public $timestamps = false;
    protected $fillable = [
        'hotel_id', 
        'category_id',
        'description',
        'cp', 
        'map',
        'ap',
        'ep', 
        'extra_person_with_mattres',
        'extra_person_without_mattres',
        'created_by',
    ];
    
}
