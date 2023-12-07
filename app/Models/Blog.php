<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'content',
        'link_image',
        'user_id',
        'category_id',
        'status',
        'created_at',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
