<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\CategoryService;
use App\Services\User\BlogService;

class BlogController extends Controller
{
    private $categoryService;
    private $blogService;

    public function __construct(CategoryService $categoryService, BlogService $blogService)
    {
        $this->categoryService = $categoryService;
        $this->blogService = $blogService;
    }

    public function myBlogs(): View
    {
        return view('user.my_blogs');
    }

    public function createBlogForm(): View
    {
        $categories = $this->categoryService->getAllCategory();
        return view('user.create_blog')->with('categories', $categories);
    }

    public function createBlog(CreateBlogRequest $request): RedirectResponse
    {
        return $this->blogService->createBlog($request->only('title', 'content', 'category_id', 'image'));
    }
}
