<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\View\View;

class CategoryService
{

    public function getAllCategory(): View
    {
        try {
            $categories = Category::all()->toArray();
            return view('user.create_blog')->with('categories', $categories);
        } catch (\Exception $ex) {
            return view('error.exception')->with('error', $ex->getMessage());
        }
    }
}
