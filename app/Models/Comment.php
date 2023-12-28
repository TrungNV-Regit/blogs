<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    const CREATE = 1;
    const UPDATE = 2;
    const DESTROY = 3;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'blog_id',
        'content',
        'created_at',
        'parent_id',
    ];

    protected $appends = [
        'time_elapsed',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTimeElapsedAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
