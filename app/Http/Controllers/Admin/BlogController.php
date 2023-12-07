<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{

    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function getBlogPendingByPage(): View
    {
        $data = $this->blogService->getBlogPendingByPage();
        return view('admin.blogs', compact('data'));
    }

    public function approveBlog(int $id): RedirectResponse
    {
        $this->blogService->approveBlog($id);
        return back();
    }
}
