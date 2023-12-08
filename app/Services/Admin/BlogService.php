<?php

namespace App\Services\Admin;

use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogService
{
    public function index(int $status): LengthAwarePaginator
    {
        return Blog::where('status', $status)->with('author')->orderByDesc('id')->paginate(config('app.per_page'));
    }

    public function changeStatus(int $id): bool
    {
        $blog = Blog::findOrFail($id);
        return $blog->update(['status' => $blog->status == Blog::STATUS_ACTIVE ? Blog::STATUS_PENDING : Blog::STATUS_ACTIVE]);
    }
}
