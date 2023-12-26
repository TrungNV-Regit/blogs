<?php

namespace App\Services\Common;

use App\Models\Comment;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService
{
    public function index(int $blogId): LengthAwarePaginator
    {
        try {
            return Comment::with('author')
                ->where('blog_id', $blogId)
                ->where('parent_id', null)
                ->orderByDesc('created_at')
                ->paginate(config('blog.per_page_comment'));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(array $data): Comment
    {
        try {
            return Comment::create($data);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function destroy(Comment $comment): int
    {
        try {
            Comment::where('parent_id', $comment->id)->delete();
            return $comment->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function update(Comment $comment, string $content): Comment
    {
        try {
            $comment->update(['content' => $content]);
            return $comment->refresh();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function getRepliesComment(int $parent_id): LengthAwarePaginator
    {
        try {
            return Comment::with('author')
                ->where('parent_id', $parent_id)
                ->orderByDesc('created_at')
                ->paginate(config('blog.per_page_comment'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
