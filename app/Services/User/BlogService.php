<?php

namespace App\Services\User;

use App\Models\Blog;
use App\Services\Common\ImageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    public function __construct(
        private ImageService $imageService,
    ) {
    }

    public function create(Request $request): Blog
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
        return Blog::with(['author', 'comments'])->findOrFail($id);
    }
}
