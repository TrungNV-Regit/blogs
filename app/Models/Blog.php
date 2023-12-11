<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $appends = [
        'time_elapsed',
        'formatted_created_date',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function randomRelatedBlog(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id', 'category_id')->where('id', '!=', $this->id)->inRandomOrder()->limit(config('blog.related_blog_limit'));
    }

    public function getTimeElapsedAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getFormattedCreatedDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'blog_id', 'user_id');
    }
}
