<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->status == User::STATUS_ACTIVE && $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user, Comment $comment): bool
    {
        return $user->status == User::STATUS_ACTIVE && $user->id === $comment->user_id;
    }
}
