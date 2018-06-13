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
  Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');

  /*
  |--------------------------------------------------------------------------
  | AUTH
  |--------------------------------------------------------------------------
  */
  
  Auth::routes();
  Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
  Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('verify');

  Route::prefix('admin')->group(function() {
    	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    	Route::get('/index', 'Admin\AdminController@index')->name('admin.index');
    	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

      // Password reset routes
      Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
      Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
      Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
      Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
  });

  /*
  |--------------------------------------------------------------------------
  | BACK END
  |--------------------------------------------------------------------------
  */

  Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin'), function(){
    // Admin change password
  	Route::get('/password/edit', 'AdminController@showPasswordForm')->name('admin.password.edit');
    Route::put('/password', 'AdminController@changePassword')->name('admin.password.update');

    Route::resource('/category', 'CategoryController');
    Route::resource('/product', 'ProductController');
    Route::resource('/size', 'SizeController');
    Route::resource('/color', 'ColorController');

    // Order
    Route::get('/order', 'OrderController@manager')->name('admin.order');
    Route::get('/order/detail/pending/{id}', 'OrderController@managerDetailPending')->name('admin.order.detail.pending');
    Route::get('/order/detail/verified/{id}', 'OrderController@managerDetailVerified')->name('admin.order.detail.verified');
    Route::get('/order/verify/{id}', 'OrderController@verify')->name('admin.order.verify');
  });

  // User
  Route::group(array('prefix' => 'admin', 'namespace' => 'User', 'middleware' => 'auth:admin'), function(){
    Route::resource('/user', 'UserController', ['only' => ['index', 'destroy']]);
  });

  /*
  |--------------------------------------------------------------------------
  | FRONT END
  |--------------------------------------------------------------------------
  */

  // User
  Route::group(array('namespace' => 'User', 'middleware' => 'auth'), function(){
    Route::get('/user/edit', 'UserController@edit')->name('user.edit');
    Route::put('/user/update', 'UserController@update')->name('user.update');
    Route::get('/user/password/edit', 'UserController@showPasswordForm')->name('user.password.edit');
    Route::put('/user/password', 'UserController@changePassword')->name('user.password.update');
    Route::resource('/user/comment', 'CommentController');
  });

  // Order
  Route::group(array('middleware' => 'auth'), function(){
    Route::get('/checkout', 'Admin\CartController@checkout')->name('checkout');
    Route::get('/order', 'Admin\OrderController@index')->name('order');
    Route::get('/order/detail/{id}', 'Admin\OrderController@detail')->name('order.detail');
  });

  // Home
  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/category/men/{id}', 'HomeController@men')->name('category.men');
  Route::get('/category/women/{id}', 'HomeController@women')->name('category.women');
  Route::get('/search', 'HomeController@search')->name('search');
  Route::resource('/product', 'Admin\ProductController', ['only' => 'show']);

  // Cart
  Route::group(array('namespace' => 'Admin'), function(){
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart/add', 'CartController@addItem')->name('cart.add');
    Route::get('/cart/remove/{rowId}', 'CartController@removeItem')->name('cart.remove');
    Route::put('/cart/update', 'CartController@update')->name('cart.update');
  });

});





