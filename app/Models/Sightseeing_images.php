<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sightseeing_images extends Model
{
    use HasFactory;
    protected $table = 'sight_seeing_images';
    public $timestamps = false;
    protected $fillable = [
        'path', 'parent_id','size'
    ];
}
