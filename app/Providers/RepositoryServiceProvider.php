<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    const CONTRACT_PATH = 'App\Repositories\Contracts';

    const ELOQUENT_PATH = 'App\Repositories\Eloquents';

    protected static $repositories = [
        'user' => [
            self::CONTRACT_PATH . '\UserRepositoryInterface',
            self::ELOQUENT_PATH . '\UserRepository',
        ],
        'admin' => [
            self::CONTRACT_PATH . '\AdminRepositoryInterface',
            self::ELOQUENT_PATH . '\AdminRepository',
        ],
        'category' => [
            self::CONTRACT_PATH . '\CategoryRepositoryInterface',
            self::ELOQUENT_PATH . '\CategoryRepository',
        ],
        'color' => [
            self::CONTRACT_PATH . '\ColorRepositoryInterface',
            self::ELOQUENT_PATH . '\ColorRepository',
        ],
        'size' => [
            self::CONTRACT_PATH . '\SizeRepositoryInterface',
            self::ELOQUENT_PATH . '\SizeRepository',
        ],
        'comment' => [
            self::CONTRACT_PATH . '\CommentRepositoryInterface',
            self::ELOQUENT_PATH . '\CommentRepository',
        ],
        'order' => [
            self::CONTRACT_PATH . '\OrderRepositoryInterface',
            self::ELOQUENT_PATH . '\OrderRepository',
        ],
        'product' => [
            self::CONTRACT_PATH . '\ProductRepositoryInterface',
            self::ELOQUENT_PATH . '\ProductRepository',
        ],
        'cart' => [
            self::CONTRACT_PATH . '\CartRepositoryInterface',
            self::ELOQUENT_PATH . '\CartRepository',
        ],
        'review' => [
            self::CONTRACT_PATH . '\ReviewRepositoryInterface',
            self::ELOQUENT_PATH . '\ReviewRepository',
        ],
    ];

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
        foreach (static::$repositories as $repository) {
            $this->app->singleton(
                $repository[0],
                $repository[1]
            );
        }
    }
}
