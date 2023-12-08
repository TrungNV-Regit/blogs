<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService
    ) {
    }

    public function index(int $status): View
    {
        $data = $this->blogService->index($status);
        return view('admin.blogs', compact('data'));
    }

    public function approve(int $id): RedirectResponse
    {
        if ( $this->blogService->approve($id) ) {
            return back()->with('notification', __('message.approve_success'));
        };
        return back()->with('notification', __('message.blog_not_found'));
    }
}
