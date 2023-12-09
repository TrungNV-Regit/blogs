<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-blog', function (User $user, Blog $blog) {
            return ( $user->status == User::STATUS_ACTIVE && $user->id === $blog->user_id ) || $user->role == User::ROLE_ADMIN;
        });

        Gate::define('delete-blog', function (User $user, Blog $blog) {
            return ( $user->status == User::STATUS_ACTIVE && $user->id === $blog->user_id ) || $user->role == User::ROLE_ADMIN;
        });
    }
}
