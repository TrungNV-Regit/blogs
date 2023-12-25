<?php

namespace App\Services\Common;

use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BlogService
{
    public function __construct(
        private ImageService $imageService,
    ) {
    }

    public function index(Request $request): LengthAwarePaginator
    {
        try {
            $categoryId = $request->input("category");
            $query = Blog::with('author')->where('status', Blog::STATUS_ACTIVE)->where('title', 'LIKE', '%' . $request->input('keyword') . '%');

            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            return $query->orderByDesc('created_at')->paginate(config('blog.per_page'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function show(int $id): Blog
    {
        try {
            return Blog::with('author', 'comments', 'likes')->where('status', Blog::STATUS_ACTIVE)->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function edit(int $id): Blog
    {
        try {
            return Blog::with('category')->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function update(Blog $blog, CreateBlogRequest $request): bool
    {
        try {
            $data = $request->only('title', 'content', 'category_id', 'image');

            if ($request->has('checkDeleteImage')) {
                $this->imageService->deleteImage($blog->link_image);
                $data['link_image'] = null;
            }

            if ($request->hasFile('image')) {
                if ($blog->link_image) {
                    $this->imageService->deleteImage($blog->link_image);
                }
                $data['link_image'] = $this->imageService->uploadImage($data['image']);
            }

            return $blog->update($data);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function destroy(Blog $blog): bool
    {
        try {
            if ($blog->link_image) {
                $this->imageService->deleteImage($blog->link_image);
            }
            return $blog->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function topBlogs(): LengthAwarePaginator
    {
        try {
            return Blog::with('author', 'likes')
                ->where('blogs.status', Blog::STATUS_ACTIVE)
                ->orderBy('blogs.created_at', 'desc')
                ->paginate(config('blog.per_page'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
