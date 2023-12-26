<?php

namespace App\Services\Admin;

use App\Models\Blog;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ManagerUserService
{
    public function index(?string $username, ?string $sortTotalBlog): LengthAwarePaginator
    {
        try {
            $query = User::with('blogs')->where('role', User::ROLE_USER);

            if ($username) {
                $query->where('username', 'LIKE', '%' . $username . '%');
            }

            if ($sortTotalBlog) {
                $query->withCount('blogs')->orderBy('blogs_count', $sortTotalBlog);
            }

            return $query->paginate(config('blog.per_page'));
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function changeStatus(int $userId): string
    {
        try {
            $user = User::findOrFail($userId);
            $newStatus = $user->status == User::STATUS_ACTIVE ? User::STATUS_BLOCKED : User::STATUS_ACTIVE;
            $user->update(['status' => $newStatus]);
            if ($newStatus == User::STATUS_ACTIVE) {
                return __('message.active');
            }
            return __('message.blocked');
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function detail(int $userId): array
    {
        try {
            $user = User::findOrFail($userId);
            $blogs = Blog::with('author')->where('user_id', $user->id)->paginate(config('blog.per_page'));
            return ['user' => $user, 'blogs' => $blogs];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
