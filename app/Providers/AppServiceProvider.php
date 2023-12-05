<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Services\Mail\MailService;
use App\Services\User\BlogService as BlogUserService;

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
        Model::preventLazyLoading(!app()->isProduction());

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
            CategoryService::class,
            function ($app) {
                return new CategoryService();
            }
        );

        $this->app->bind(
            BlogUserService::class,
            function ($app) {
                return new BlogUserService();
            }
        );
    }
}
