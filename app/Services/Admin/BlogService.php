<?php

namespace App\Services\Admin;

use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

class BlogService
{
    public function index(int $status): LengthAwarePaginator
    {
        return Blog::where('status', $status)->with('author')->orderByDesc('id')->paginate(config('blog.per_page'));
    }

    public function changeStatus(int $id): bool
    {
        try {
            $blog = Blog::findOrFail($id);
            return $blog->update(['status' => $blog->status == Blog::STATUS_ACTIVE ? Blog::STATUS_PENDING : Blog::STATUS_ACTIVE]);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
