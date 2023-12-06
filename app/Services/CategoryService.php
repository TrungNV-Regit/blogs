<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\View\View;

class CategoryService
{

    public function getAllCategory(): array
    {
        try {
            return Category::all()->toArray();
        } catch (\Exception $ex) {
            return ;
        }
    }
}
