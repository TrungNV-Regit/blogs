<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Services\Common\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(
        private LikeService $likeService,
    ) {
    }

    public function like(Request $request): string
    {
        $data = $this->likeService->like($request->input('blogId'));
        return json_encode($data);
    }
}
