<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use App\Services\Admin\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\Common\BlogService as CommonBlogService;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService,
        private CommonBlogService $commonBlogService,
    ) {
    }

    public function index(): View
    {
        $status = request()->query('status');
        $data = $this->blogService->index($status);
        $statuses = config('blog.statuses');
        return view('admin.blog.list', compact('data', 'statuses'));
    }

    public function changeStatus(int $id): RedirectResponse
    {
        $this->blogService->changeStatus($id);
        return back()->with('notification', __('message.change_status_success'));
    }

    public function show(int $id): View
    {
        $blog = $this->blogService->show($id);
        return view('admin.blog.manager')->with(['blog' => $blog, 'user' => auth()->user()]);
    }

    public function update(int $id, CreateBlogRequest $request): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
        $this->commonBlogService->update($blog, $request);
        return redirect()->route('admin.blog.show', ['id' => $id])->with('notification', __('message.update_blog_success'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
        $this->commonBlogService->destroy($blog);
        return redirect()->route('admin.blog.index', ['status' => $blog->status])->with('notification', __('message.delete_blog_success'));
    }
}
