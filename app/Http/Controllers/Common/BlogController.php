<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use App\Models\User;
use App\Services\Common\CategoryService;
use App\Services\Common\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService,
        private CategoryService $categoryService,
    ) {
    }

    public function edit(int $id): View
    {
        $blog = $this->blogService->show($id);
        Gate::authorize('update', $blog);
        $categories = $this->categoryService->index();
        return view('blogs.update')->with(['blog' => $blog, 'categories' => $categories]);
    }
}
