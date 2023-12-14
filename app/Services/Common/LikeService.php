<?php

namespace App\Services\Common;

use App\Models\Blog;
use Exception;

class LikeService
{
    public function like(int $blogId): bool
    {
        try {
            $user = auth()->user();
            $liked = $user->likes()->where('blog_id', $blogId)->exists();
            if ($liked) {
                $user->likes()->detach($blogId);
            } else {
                $user->likes()->attach($blogId);
            }
            return $liked;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
