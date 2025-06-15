<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_category extends Model
{
    use HasFactory;
    protected $table = 'hotel_category';

    protected $fillable = [
        'category_title',
        'subtitle',
    ];
}
