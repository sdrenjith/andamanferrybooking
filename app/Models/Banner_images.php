<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner_images extends Model
{
    use HasFactory;
    protected $table = 'banner_images';
    public $timestamps = false;
    protected $fillable = [
        'path', 'parent_id','size'
    ];
    public function banner()
    {
        return $this->belongsTo(Banners::class, 'parent_id');
    }
}
