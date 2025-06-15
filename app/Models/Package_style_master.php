<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package_style_master extends Model
{
    use HasFactory;
    protected $table = 'package_styles_master';

    protected $fillable = [
        'title',
        'status',
        'created_at',
        'updated_at',
    ];
}
