<?php

namespace App\Services\Admin;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ManagerUserService
{
    public function index(string|null $username): LengthAwarePaginator
    {
        try {
            return User::with('blogs')
                ->where('username', 'LIKE', '%' . $username . '%')
                ->where('role', User::ROLE_USER)
                ->paginate(config('blog.per_page'));
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
}
