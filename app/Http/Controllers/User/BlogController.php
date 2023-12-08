<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\CategoryService;
use App\Services\User\BlogService;
use Illuminate\Support\Facades\Auth;

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

    public function create(): View
    {
        $categories = $this->categoryService->index();
        return view('user.create_blog')->with('categories', $categories);
    }

    public function store(CreateBlogRequest $request): RedirectResponse
    {
        $this->blogService->create($request->only('title', 'content', 'category_id', 'image'), $request->hasFile('image') ? true : false);
        return back()->with('notification', trans('message.create_blog_success'));
    }

    public function show(int $id): View
    {
        $blog = $this->blogService->show($id);
        return view('user.detail_blog')->with('blog', $blog)->with('user', Auth::user());
    }
}
