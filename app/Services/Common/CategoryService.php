<?php

namespace App\Services\Common;

use App\Models\Category;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function index(string|null $sortOrder = 'DESC'): LengthAwarePaginator
    {
        try {
            $query = Category::with('blogs')->withCount('blogs');

            if ($sortOrder) {
                $query->orderBy('blogs_count', $sortOrder);
            }

            return $query->paginate(config('blog.per_page'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function store(array $data): Category
    {
        try {
            return Category::create($data);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function update(array $data): bool
    {
        try {
            $category = Category::findOrFail($data['id']);
            return $category->update($data);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function destroy(Category $category): bool
    {
        try {
            return $category->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
