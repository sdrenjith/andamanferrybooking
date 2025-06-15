<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_images extends Model
{
    use HasFactory;
    protected $table = 'activity_images';
    public $timestamps = false;
    protected $fillable = [
        'path', 'parent_id','size'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }
}
