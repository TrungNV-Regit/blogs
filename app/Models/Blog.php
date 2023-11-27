<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'id',
        'title',
        'content',
        'link_image',
        'user_id',
        'category_id',
        'status',
        'created_at'
    ];
}
