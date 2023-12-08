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

    public function changeStatus(int $id): Blog
    {
        $blog = Blog::findOrFail($id);
        $isActive = $blog->status == Blog::STATUS_ACTIVE ? true : false;
        if ( $isActive ) {
            $blog->update(['status' => Blog::STATUS_PENDING]);
        } else {
            $blog->update(['status' => Blog::STATUS_ACTIVE]);
        }
        return $blog;
    }
}
