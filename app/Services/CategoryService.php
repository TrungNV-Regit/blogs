<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function index(): array
    {
        return Category::all()->toArray();
    }
}
