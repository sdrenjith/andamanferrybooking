<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package_style extends Model
{
    use HasFactory;
    protected $table = 'package_styles';

    protected $fillable = [
        'package_id',
        'package_style_id',
        'created_at',
        'updated_at',
       
    ];
}
