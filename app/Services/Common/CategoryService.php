<?php

namespace App\Services\Common;

use App\Models\Category;
use Exception;

class CategoryService
{

    public function index(): array
    {
        try {
            return Category::all()->toArray();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
