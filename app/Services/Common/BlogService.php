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
    
    public function edit(int $id): Blog
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
            
            if ( $request->hasFile('image') ) {
                $data['link_image']  = $this->imageService->uploadImage($data['image']);
            } else if ( $request->has('checkDeleteImage') ) {
                $data['link_image'] = null;
            }

            return $blog->update($data);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
