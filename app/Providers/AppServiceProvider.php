<?php

namespace App\Providers;

use App\Services\User\MailService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            UserService::class, function ($app) {
                return new UserService();
            }
        );
    }
}
