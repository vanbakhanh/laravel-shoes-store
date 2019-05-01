<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['middleware' => 'locale'], function () {
    Route::get('languages/{language}', 'HomeController@changeLanguage')->name('user.language');

    /*
    |--------------------------------------------------------------------------
    | AUTH GUEST
    |--------------------------------------------------------------------------
     */

    Auth::routes();
    Route::get('login/{provider}', 'SocialController@redirect');
    Route::get('login/{provider}/callback','SocialController@callback');

    // User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/verify/{token}', 'UserController@verify')->name('user.verify');
        Route::post('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
    });

    // Admin
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Auth'], function () {
        // Auth
        Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
        Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');

        // Password Reset
        Route::group(['prefix' => 'admin/password'], function () {
            Route::post('/email', 'AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
            Route::get('/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
            Route::post('/reset', 'AdminResetPasswordController@reset');
            Route::get('/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('admin.password.reset');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | AUTH ADMIN
    |--------------------------------------------------------------------------
     */

    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:admin'], function () {
        // Dashboard
        Route::get('/index', 'DashboardController@index')->name('dashboard.index');

        // Admin
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/index', 'AdminController@index')->name('admin.index');
            Route::get('/password/edit/{admin}', 'AdminController@showPasswordForm')->name('admin.password.edit');
            Route::put('/password/{admin}', 'AdminController@changePassword')->name('admin.password.update');
        });

        Route::resource('/category', 'CategoryController');
        Route::resource('/product', 'ProductController');
        Route::resource('/size', 'SizeController');
        Route::resource('/color', 'ColorController');
        Route::resource('/review', 'ReviewController');

        // Order
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@manager')->name('order.manager');
            Route::get('/detail/{id}/pending', 'OrderController@managerDetailPending')->name('order.detail.pending');
            Route::get('/detail/{id}/verified', 'OrderController@managerDetailVerified')->name('order.detail.verified');
            Route::get('/detail/{id}/shipped', 'OrderController@managerDetailShipped')->name('order.detail.shipped');
            Route::get('/status/{id}/update', 'OrderController@updateStatus')->name('order.status.update');
            Route::delete('/delete/{id}', 'OrderController@destroy')->name('order.delete');
        });

        // User
        Route::resource('/user', 'UserController', ['only' => ['index', 'destroy']]);
    });

    /*
    |--------------------------------------------------------------------------
    | AUTH USER
    |--------------------------------------------------------------------------
     */

    Route::group(['middleware' => 'auth'], function () {
        // User
        Route::resource('user', 'UserController', ['only' => ['edit', 'update']]);
        Route::group(['prefix' => 'user'], function () {
            Route::get('/password/edit/{user}', 'UserController@showPasswordForm')->name('user.password.edit');
            Route::put('/password/{user}', 'UserController@changePassword')->name('user.password.update');
        });

        // Profile
        Route::resource('profile', 'ProfileController', ['only' => ['update']]);

        // Comment
        Route::resource('/comment', 'CommentController');

        // Review
        Route::resource('/review', 'ReviewController', ['only' => ['create']]);

        // Order
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index')->name('order');
            Route::get('/detail/{id}', 'OrderController@detail')->name('order.detail');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | GUEST
    |--------------------------------------------------------------------------
     */

    // Home
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/category/men/{id}', 'HomeController@men')->name('category.men');
    Route::get('/category/women/{id}', 'HomeController@women')->name('category.women');
    Route::get('/search', 'HomeController@search')->name('search');

    // Policy
    Route::get('/policy', function () {
        return view('frontend.policy.index');
    })->name('policy');

    //Product
    Route::resource('/product', 'ProductController', ['only' => 'show']);

    // Cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@index')->name('cart.index');
        Route::post('/add', 'CartController@addItem')->name('cart.add');
        Route::delete('/remove/{rowId}', 'CartController@removeItem')->name('cart.remove');
        Route::put('/update', 'CartController@update')->name('cart.update');
        Route::get('/checkout', 'CartController@checkout')->name('checkout');
    });
});
