<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
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
        $statuses = [
            Blog::STATUS_ACTIVE => __('message.active'),
            Blog::STATUS_PENDING => __('message.pending'),
        ];
        return view('admin.blogs', compact('data', 'statuses'));
    }

    public function changeStatus(int $id): RedirectResponse
    {
        $this->blogService->changeStatus($id);
        return back()->with('notification', __('message.change_status_success'));
    }
}
