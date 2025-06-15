<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activitys';

    protected $fillable = [
        'title',
        'subtitle',
        'activity_category',
        'price',
        'status',
        'delete',
       
    ];

    public function activity_images()
    {
        // return $this->belongsTo(Activity_images::class, 'parent_id');
        return $this->hasMany(Activity_images::class, 'parent_id', 'id');
    }
}
