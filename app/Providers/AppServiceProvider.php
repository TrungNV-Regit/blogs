<?php

namespace App\Providers;

use App\Services\Auth\AuthenticationService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Services\Mail\MailService;

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
        Model::preventLazyLoading();

        $this->app->bind(
            UserService::class,
            function ($app) {
                return new UserService();
            }
        );

        $this->app->bind(
            MailService::class,
            function ($app) {
                return new MailService();
            }
        );

        $this->app->bind(
            AuthenticationService::class,
            function ($app) {
                return new AuthenticationService();
            }
        );
    }
}
