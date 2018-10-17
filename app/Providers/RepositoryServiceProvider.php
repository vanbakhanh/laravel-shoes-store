<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
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

        $this->app->bind(
            'App\Repositories\Contracts\OrderRepositoryInterface',
            'App\Repositories\Eloquents\OrderRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ProductRepositoryInterface',
            'App\Repositories\Eloquents\ProductRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CartRepositoryInterface',
            'App\Repositories\Eloquents\CartRepository'
        );
    }
}
