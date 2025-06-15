<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'title', 'subtitle', 'button_text', 'button_link', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status', 'delete'
    ];
    public function bannerimage()
    {
        return $this->hasMany(Banner_images::class, 'parent_id');
    }
}
