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
    
    public function changeStatus(int $id, int $status): RedirectResponse
    {
        if ( $this->blogService->changeStatus($id, $status) ) {
            return back()->with('notification', __('message.change_status_success'));
        };
        return back()->with('notification', __('message.blog_not_found'));
    }
}
