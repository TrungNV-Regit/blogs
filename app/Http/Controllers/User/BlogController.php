<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\Common\CategoryService;
use App\Services\User\BlogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\Common\BlogService as CommonBlogService;

class BlogController extends Controller
{
    public function __construct(
        private CategoryService $categoryService,
        private BlogService $blogService,
        private CommonBlogService $commonBlogService,
    ) {
    }

    public function myBlogs(): View
    {
        $blogs = $this->blogService->myBlogs();
        return view('user.blogs', compact('blogs'));
    }

    public function create(): View
    {
        $categories = $this->categoryService->index();
        return view('blogs.create')->with('categories', $categories);
    }

    public function store(CreateBlogRequest $request): RedirectResponse
    {
        $this->blogService->create($request);
        return redirect()->route('user.blog.my-blogs')->with('notification', trans('message.create_blog_success'));
    }

    public function show(int $id): View
    {
        $blog = $this->blogService->show($id);
        return view('blogs.detail')->with(['blog' => $blog, 'user' => Auth::user()]);
    }

    public function update(int $id, CreateBlogRequest $request): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
        Gate::authorize('update', $blog);
        $this->commonBlogService->update($blog, $request);
        return redirect()->route('blog.show', ['id' => $id])->with('notification', __('message.update_blog_success'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
        Gate::authorize('delete', $blog);
        $this->commonBlogService->destroy($blog);
        return redirect()->route('user.blog.my-blogs')->with('notification', __('message.delete_blog_success'));
    }
}
