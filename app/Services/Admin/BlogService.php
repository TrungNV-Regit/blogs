<?php

namespace App\Services\Admin;

use App\Models\Blog;

class BlogService
{

    public function getBlogPendingByPage(int $page = 1): array
    {
        try {
            $data = Blog::where('status', Blog::STATUS_PENDING)->with('author')->orderByDesc('id')->paginate(9, ['*'], $page);
            $blogs = $data->items();
            $totalPages = $data->lastPage();
            $currentPage = $data->currentPage();
            return ['blogs' => $blogs, 'totalPages' => $totalPages, 'currentPage' => $currentPage];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function approveBlog(int $idBlog): void
    {
        try {
            Blog::where('id', $idBlog)->update(['status' => Blog::STATUS_ACTIVE]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
