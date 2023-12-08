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

    public function approve(int $id): bool
    {
        $blog = Blog::findOrFail($id);
        if ($blog) {
            $blog->update(['status' => Blog::STATUS_ACTIVE]);
            return true;
        }
        return false;
    }
}
