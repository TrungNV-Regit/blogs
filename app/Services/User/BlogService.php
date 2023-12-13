<?php

namespace App\Services\User;

use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use App\Services\Common\ImageService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogService
{
    public function __construct(
        private ImageService $imageService,
    ) {
    }

    public function create(CreateBlogRequest $request): Blog
    {
        try {
            $user = Auth::user();

            $blog = $request->only('title', 'content', 'category_id', 'image');

            $blog = [
                ...$blog,
                'user_id' => $user->id,
                'status' => Blog::STATUS_PENDING,
                'link_image' => null,
            ];

            if ($request->hasFile('image')) {
                $blog['link_image']  = $this->imageService->uploadImage($blog['image']);
            }

            return Blog::create($blog);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function show(int $id): Blog
    {
        try {
            return Blog::with(['author', 'comments', 'likes'])->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function myBlogs(): LengthAwarePaginator
    {
        try {
            $userId = auth()->user()->id;
            return Blog::where('user_id', $userId)->orderByDesc('id')->paginate(config('blog.per_page'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
