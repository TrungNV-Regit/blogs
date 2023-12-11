<?php

namespace App\Services\Common;

use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use Exception;

class BlogService
{
    public function __construct(
        private ImageService $imageService,
    ) {
    }

    public function show(int $id): Blog
    {
        try {
            return Blog::with('category')->findOrFail($id);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function update(Blog $blog, CreateBlogRequest $request): bool
    {
        try {
            $data = $request->only('title', 'content', 'category_id', 'image');

            if ( $request->has('checkDeleteImage') ) {
                $this->imageService->deleteImage($blog->link_image);
                $data['link_image'] = null;
            }

            if ( $request->hasFile('image') ) {
                if ( $blog->link_image ) {
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
            if ( $blog->link_image ) {
                $this->imageService->deleteImage($blog->link_image);
            }
            return $blog->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
