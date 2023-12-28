<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('like.{blogId}', function (User $user) {
    return $user->role === User::ROLE_ADMIN || $user->status === User::STATUS_ACTIVE;
});

Broadcast::channel('createcomment.{blogId}', function (User $user) {
    return $user->role === User::ROLE_ADMIN || $user->status === User::STATUS_ACTIVE;
});

Broadcast::channel('update-comment.{blogId}', function (User $user) {
    return $user->role === User::ROLE_ADMIN || $user->status === User::STATUS_ACTIVE;
});

Broadcast::channel('destroy-comment.{blogId}', function (User $user) {
    return $user->role === User::ROLE_ADMIN || $user->status === User::STATUS_ACTIVE;
});
