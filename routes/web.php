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

Route::group(['middleware' => 'locale'], function() {
    Route::get('language/{language}', 'Frontend\HomeController@changeLanguage')->name('user.language');

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    Auth::routes();
    Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('verify');
    Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

    Route::group(array('prefix' => 'admin', 'namespace' => 'Auth'), function() {
        // Admin Auth
        Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
        Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');

        // Password Reset
        Route::post('/password/email', 'AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'AdminResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    });

    /*
    |--------------------------------------------------------------------------
    | BACK END
    |--------------------------------------------------------------------------
    */

    Route::group(array('prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'auth:admin'), function(){
        // Admin
        Route::get('/index', 'AdminController@index')->name('admin.index');
        Route::get('/password/edit/{admin}', 'AdminController@showPasswordForm')->name('admin.password.edit');
        Route::put('/password/{admin}', 'AdminController@changePassword')->name('admin.password.update');

        Route::resource('/category', 'CategoryController');
        Route::resource('/product', 'ProductController');
        Route::resource('/size', 'SizeController');
        Route::resource('/color', 'ColorController');

        // Order
        Route::get('/order', 'OrderController@manager')->name('order.manager');
        Route::get('/order/detail/pending/{id}', 'OrderController@managerDetailPending')->name('order.detail.pending');
        Route::get('/order/detail/verified/{id}', 'OrderController@managerDetailVerified')->name('order.detail.verified');
        Route::get('/order/verify/{id}', 'OrderController@verify')->name('order.verify');
        Route::delete('/order/delete/{id}', 'OrderController@destroy')->name('order.delete');
    });

    // User
    Route::group(array('prefix' => 'admin', 'namespace' => 'Frontend', 'middleware' => 'auth:admin'), function(){
        Route::resource('/user', 'UserController', ['only' => ['index', 'destroy']]);
    });

    /*
    |--------------------------------------------------------------------------
    | FRONT END
    |--------------------------------------------------------------------------
    */

    // User
    Route::group(array('namespace' => 'Frontend', 'middleware' => 'auth'), function(){
        Route::resource('/user', 'UserController', ['only' => ['edit', 'update']]);
        Route::get('/user/password/edit/{user}', 'UserController@showPasswordForm')->name('user.password.edit');
        Route::put('/user/password/{user}', 'UserController@changePassword')->name('user.password.update');
        Route::resource('/comment', 'CommentController');
    });

    // Order
    Route::group(array('namespace' => 'Backend', 'middleware' => 'auth'), function(){
        Route::get('/order', 'OrderController@index')->name('order');
        Route::get('/order/detail/{id}', 'OrderController@detail')->name('order.detail');
    });

    // Home
    Route::group(array('namespace' => 'Frontend'), function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/category/men/{id}', 'HomeController@men')->name('category.men');
        Route::get('/category/women/{id}', 'HomeController@women')->name('category.women');
        Route::get('/search', 'HomeController@search')->name('search');
    });
    
    //Product
    Route::resource('/product', 'Backend\ProductController', ['only' => 'show']);

    // Cart
    Route::group(array('namespace' => 'Frontend'), function(){
        Route::get('/cart', 'CartController@index')->name('cart.index');
        Route::post('/cart/add', 'CartController@addItem')->name('cart.add');
        Route::get('/cart/remove/{rowId}', 'CartController@removeItem')->name('cart.remove');
        Route::put('/cart/update', 'CartController@update')->name('cart.update');
    });
    Route::group(array('namespace' => 'Frontend', 'middleware' => 'auth'), function(){
        Route::get('/checkout', 'CartController@checkout')->name('checkout');
    });

});





