<?php

namespace App\Services\Common;

use App\Events\LikeEvent;
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
            broadcast(new LikeEvent($blogId, $liked))->toOthers();
            return $liked;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
