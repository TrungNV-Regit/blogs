<?php

namespace App\Services\Admin;

use App\Models\Blog;
use App\Services\Common\ImageService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogService
{
    public function __construct(
        private ImageService $imageService,
    ) {
    }

    public function index(int $status): LengthAwarePaginator
    {
        try {
            return Blog::where('status', $status)->with('author')->orderByDesc('id')->paginate(config('blog.per_page'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function changeStatus(int $id): bool
    {
        try {
            $blog = Blog::findOrFail($id);
            return $blog->update(['status' => $blog->status == Blog::STATUS_ACTIVE ? Blog::STATUS_PENDING : Blog::STATUS_ACTIVE]);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function show(int $id): Blog
    {
        try {
            return Blog::with(['author', 'comments'])->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
