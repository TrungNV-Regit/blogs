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

    public function changeStatus(int $id, int $status): bool
    {
        return Blog::findOrFail($id)->update(['status' => $status]);
    }
}
