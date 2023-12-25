<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Blog $blog): bool
    {
        return ( $user->status == User::STATUS_ACTIVE && $user->id === $blog->user_id ) || $user->role == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Blog $blog): bool
    {
        return ( $user->status == User::STATUS_ACTIVE && $user->id === $blog->user_id ) || $user->role == User::ROLE_ADMIN;
    }

    public function like(User $user): bool
    {
        return $user->status == User::STATUS_ACTIVE;
    }
}
