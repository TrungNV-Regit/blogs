<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Common\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService,
    ) {
    }

    public function index(Request $request): View
    {
        $categories = $this->categoryService->index($request->order);
        return view('admin.category.index')->with('categories', $categories);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->only(['name']);
        $this->categoryService->store($data);
        return back()->with('notification', __('message.create_category_success'));
    }

    public function edit(Request $request): View
    {
        $categories = $this->categoryService->index($request->order);
        return view('admin.category.index')->with(['categories' => $categories, 'id' => $request->id,'page' => $request->page]);
    }

    public function update(CategoryRequest $request): RedirectResponse
    {
        $data = $request->only(['id', 'name']);
        $this->categoryService->update($data);
        return redirect()->route('admin.category.index')->with('notification', __('message.update_category_success'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $category = Category::findOrFail($request->id);
        Gate::authorize('delete', $category);
        $this->categoryService->destroy($category);
        return back()->with('notification', __('message.delete_category_success'));
    }
}
