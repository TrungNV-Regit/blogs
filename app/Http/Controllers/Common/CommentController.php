<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\Common\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function __construct(
        private CommentService $commentService,
    ) {
    }

    public function index(Request $request): View
    {
        $blogId = $request->blogId;
        $data = $this->commentService->index($blogId);
        return view('blogs.comments')->with(['data' => $data, 'user' => auth()->user(), 'blogId' => $blogId]);
    }

    public function store(Request $request): string
    {
        Gate::authorize('create', Comment::class);
        $user = auth()->user();
        $data = $request->only('blog_id', 'content');
        if ($request->has('parentId')) {
            $data['parent_id'] = $request->parentId;
        }
        $comment = $this->commentService->store([...$data, 'user_id' => $user->id]);
        return json_encode(
            [
                'comment' => $comment,
                'user' => $user,
            ]
        );
    }

    public function destroy(Request $request): string
    {
        $comment = Comment::findOrFail($request->id);
        Gate::authorize("destroy", $comment);
        $this->commentService->destroy($comment);
        return json_encode($comment);
    }

    public function update(Request $request): string
    {
        $comment = Comment::findOrFail($request->id);
        Gate::authorize("update", $comment);
        $result = $this->commentService->update($comment, $request->content);
        return json_encode($result);
    }

    public function getRepliesComment(Request $request): View
    {
        $data = $this->commentService->getRepliesComment($request->parentId);
        $user = auth()->user();
        return view('blogs.reply_comment')->with(['data' => $data, 'user' => $user]);
    }
}
