<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryLocation extends Model
{
    use HasFactory;
    protected $table = 'ferry_locations';

    protected $fillable = [
        'title','code','status'
    ];
}
