<?php

namespace App\Services\User;

use App\Models\Blog;
use App\Services\Common\ImageService;
use Exception;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    public function __construct(
        private ImageService $imageService,
    ) {
    }

    public function create(array $blog, bool $hasFile): Blog
    {
        try {
            $user = Auth::user();

            $blog = [
                ...$blog,
                'user_id' => $user->id,
                'status' => Blog::STATUS_PENDING,
                'link_image' => null,
            ];

            if ($hasFile) {
                $blog['link_image']  = $this->imageService->uploadImage($blog);
            }

            $blog = Blog::create($blog);
            return $blog;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function show(int $id): Blog
    {
        return Blog::with(['author', 'comments'])
        ->find($id);
    }
}
