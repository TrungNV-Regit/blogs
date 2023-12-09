<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use App\Services\Common\CategoryService;
use App\Services\Common\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $blog = $this->blogService->edit($id);
        $categories = $this->categoryService->index();

        if ( Gate::allows('update-blog', $blog) ) {
            return view('common.update_blog')->with(['blog' => $blog, 'categories' => $categories]);
        }
        return abort(403, trans('message.auth'));
    }

    public function update(int $id, CreateBlogRequest $request): RedirectResponse
    {
        $blog = Blog::findOrFail($id);

        if ( Gate::allows('update-blog', $blog) ) {
            $this->blogService->update($blog, $request);
            return redirect()->route('blog.show', ['id' => $id])->with('notification', __('message.update_blog_success'));
        }
        return abort(403, trans('message.auth'));
    }
}
