<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\CategoryRepositoryInterface',
            'App\Repositories\Eloquents\CategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ColorRepositoryInterface',
            'App\Repositories\Eloquents\ColorRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\SizeRepositoryInterface',
            'App\Repositories\Eloquents\SizeRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CommentRepositoryInterface',
            'App\Repositories\Eloquents\CommentRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquents\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\AdminRepositoryInterface',
            'App\Repositories\Eloquents\AdminRepository'
        );
    }
}
