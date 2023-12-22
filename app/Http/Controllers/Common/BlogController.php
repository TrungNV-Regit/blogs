<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Services\Common\CategoryService;
use App\Services\Common\BlogService;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService,
        private CategoryService $categoryService,
    ) {
    }

    public function show(int $id): View
    {
        $blog = $this->blogService->show($id);
        return view('blogs.detail')->with(['blog' => $blog, 'user' => auth()->user()]);
    }

    public function edit(int $id): View
    {
        $blog = $this->blogService->edit($id);
        Gate::authorize('update', $blog);
        $categories = $this->categoryService->index();
        return view('blogs.update')->with(['blog' => $blog, 'categories' => $categories]);
    }

    public function index(Request $request): View
    {
        $data = $this->blogService->index($request);
        $categories = $this->categoryService->index();
        return view('user.home')->with(['data' => $data, 'categories' => $categories]);
    }

    public function top()
    {
        $blogs = $this->blogService->topBlogs();
        return view('user.top_blogs')->with(['blogs' => $blogs]);
    }
}
