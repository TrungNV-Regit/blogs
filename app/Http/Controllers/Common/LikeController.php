<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\Common\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LikeController extends Controller
{
    public function __construct(
        private LikeService $likeService,
    ) {
    }

    public function like(Request $request): string
    {
        Gate::authorize('like', Blog::class);
        $data = $this->likeService->like($request->input('blogId'));
        return json_encode($data);
    }
}
