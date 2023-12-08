<?php

namespace App\Services\Admin;

use App\Models\Blog;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogService
{
    public function index(int $status): LengthAwarePaginator
    {
        try {
            return Blog::where('status', $status)->with('author')->orderByDesc('id')->paginate(9);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function approve(int $id): bool
    {
        try {
            $blog = Blog::findOrFail($id);
            if ($blog) {
                $blog->update(['status' => Blog::STATUS_ACTIVE]);
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
