<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'faq';

    protected $fillable = [
        'qusetions',
        'answers',
        'related_module',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
        'status',
    ];
}
