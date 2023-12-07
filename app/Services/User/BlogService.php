<?php

namespace App\Services\User;

use App\Models\Blog;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogService
{

    public function createBlog(array $blog, bool $hasFile): void
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
                $file = $blog['image'];
                $fileName = time() . '.' . $file->extension();
                $imagePath = $file->storeAs('public/images', $fileName);
                $linkImage = Storage::url($imagePath);
                $blog['link_image']  = $linkImage;
            }

            Blog::create($blog);
        
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function getBlogDetail(int $idBlog): Blog
    {
        try {
            $blog = Blog::where('id', $idBlog)->with(['author', 'comments'])->first();
            return $blog;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
