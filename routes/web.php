<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['CheckRole','auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', 'DashboardController@show')->name('dashboard')->middleware('auth', 'verified', 'CheckRole');
        Route::prefix('product')->group(function () {
            Route::get('list', 'ProductController@show')->name('product.index')->middleware('can:product.view');
            Route::get('add', 'ProductController@add')->name('product.add')->middleware('can:product.add');
            Route::post('store', 'ProductController@store')->name('product.store');
            Route::get('edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('can:product.edit');
            Route::post('update/{id}', 'ProductController@update')->name('product.update');
            Route::get('delete/{id}', 'ProductController@delete')->name('product.delete')->middleware('can:product.delete');
        });
        Route::prefix('/cat_product')->group(function () {
            Route::get('list', 'CategoryProductController@show')->name('categoryProduct.index')->middleware('can:categoryProduct.view');
            Route::get('add', 'CategoryProductController@add')->name('categoryProduct.add')->middleware('can:categoryProduct.add');
            Route::post('store', 'CategoryProductController@store')->name('categoryProduct.store');
            Route::get('update/{id}', 'CategoryProductController@getupdate')->name('categoryProduct.getupdate')->middleware('can:categoryProduct.edit');
            Route::post('update/{id}', 'CategoryProductController@update')->name('categoryProduct.update');
            Route::get('delete/{id}', 'CategoryProductController@delete')->name('categoryProduct.delete')->middleware('can:categoryProduct.delete');
        });
        Route::prefix('cat_post')->group(function () {
            Route::get('list', 'CategoryPostController@show');
            Route::post('add', 'CategoryPostController@add');
            Route::get('update/{id}', 'CategoryPostController@update')->name('categoryPost.update');
            Route::post('store/{id}', 'CategoryPostController@store')->name('categoryPost.store');
            Route::get('delete/{id}', 'CategoryPostController@delete')->name('categoryPost.delete');
        });
        Route::prefix('post')->group(function () {
            Route::get('list', 'PostController@show');
            Route::get('add', 'PostController@add');
            Route::post('store', 'PostController@store');
        });
        Route::prefix('slider')->group(function () {
            Route::get('list', 'AdminSliderController@show')->name('slider.index')->middleware('can:slider.view');
            Route::post('add', 'AdminSliderController@add')->name('slider.add')->middleware('can:slider.add');
            Route::get('delete/{id}', 'AdminSliderController@delete')->name('slider.delete')->middleware('can:slider.delete');
        });
        Route::prefix('productImage')->group(function () {
            Route::get('list/{id}', 'ProductImageController@show')->name('product.image');
            Route::get('edit/{id}', 'ProductImageController@edit')->name('productImage.edit');
            Route::get('delete/{id}', 'ProductImageController@delete')->name('productImage.delete');
        });
        Route::prefix('order')->group(function () {
            Route::get('list', 'AdminOrderController@show')->name('order.index')->middleware('can:order.view');
            Route::post('create', 'AdminOrderController@create')->name('order.add')->middleware('can:order.add');
            Route::get('detail/{id}', 'AdminOrderController@detail')->name('order.detail')->middleware('can:order.edit');
            Route::post('detail/{id}', 'AdminOrderController@update')->middleware('can:order.view');

        });
        Route::prefix('user')->group(function () {
            Route::get('list', 'AdminUserController@show')->name('user.index')->middleware('can:user.view');
            Route::get('add', 'AdminUserController@add')->name('user.add')->middleware('can:user.add');
            Route::post('store', 'AdminUserController@store')->name('user.store');
            Route::get('edit/{id}', 'AdminUserController@edit')->name('user.edit')->middleware('can:user.edit');
            Route::post('update/{id}', 'AdminUserController@update')->name('user.update');
            Route::get('delete/{id}', 'AdminUserController@delete')->name('user.delete')->middleware('can:user.delete');
            Route::get('test', 'AdminUserController@test')->name('user.test');
        });
        Route::prefix('permission')->group(function () {
            Route::get('create', 'PermissionController@create')->name('permission.create')->middleware('can:permission.view');
            Route::get('add', 'PermissionController@add')->name('permission.add')->middleware('can:permission.add');;
            Route::post('store', 'PermissionController@store')->name('permission.store');
            Route::get('delete/{id}', 'PermissionController@delete')->name('permission.delete')->middleware('can:permission.delete');;

        });
        Route::prefix('role')->group(function () {
            Route::get('index', 'RoleController@index')->name('role.index')->middleware('can:role.view');
            Route::get('add', 'RoleController@add')->name('role.add')->middleware('can:role.add');
            Route::post('store', 'RoleController@store')->name('role.store');
            Route::get('edit/{role}', 'RoleController@edit')->name('role.edit')->middleware('can:role.edit');
            Route::post('update/{role}', 'RoleController@update')->name('role.update');
            Route::get('delete/{role}', 'RoleController@delete')->name('role.delete')->middleware('can:role.delete');
        });
    });
});

//user profile
Route::middleware(['can:user-profile'])->group(function () {
    Route::get('profile', 'UserProfileController@index')->name('profile.index');
    Route::get('profile/edit', 'UserProfileController@edit')->name('profile.edit');
    Route::post('profile/update', 'UserProfileController@update')->name('profile.update');
    Route::get('logout', 'UserProfileController@logout')->name('profile.logout');
});

//HOME
Route::get('/', 'UserHomeController@index')->name('home');

Route::get('detail/list/{id}', 'UserProductController@detailProduct')->name('detail.product');

//user product
Route::post('check', 'UserProductController@check')->name('check.test');
Route::get('product/{id}', 'UserProductController@show')->name('product.show');
Route::get('product', 'UserProductController@search')->name('product.search');
Route::get('check/{id}', 'UserProductController@check');

//post
Route::get('post', 'UserPostController@show')->name('post.index');
Route::get('post/{slug}', 'UserPostController@detailPost')->name('detailPost.index');


//checkout
Route::get('checkout/{id}', 'UserCheckOutController@checkoutHome')->name('checkout.product'); //checkout from home
Route::post('checkout', 'UserCheckOutController@show')->name('checkout.index');
Route::get('delete', 'UserCheckOutController@delete')->name('checkout.delete');
Route::get('show', 'UserCheckOutController@index')->name('checkout.show');
// cart
Route::get('gio-hang', 'UserCartController@show')->name('cart.index');
Route::post('cart/add/{id}', 'UserCartController@add')->name('cart.add');
Route::get('cart/delete/{rowId}', 'UserCartController@delete')->name('cart.delete');
Route::get('cart/update', 'UserCartController@update')->name('cart.update');
Route::get('cart/ajax', 'UserCartController@ajax')->name('cart.ajax');
Route::get('cart/destroy', 'UserCartController@destroy')->name('cart.destroy');



