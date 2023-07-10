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

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard', 'DashboardController@show')->name('dashboard')->middleware('auth','verified','CheckRole');

//category product
Route::get('admin/cat_product/list', 'CategoryProductController@show');
Route::get('admin/cat_product/add', 'CategoryProductController@add');
Route::post('admin/cat_product/store', 'CategoryProductController@store');
Route::get('admin/cat_product/update/{id}', 'CategoryProductController@getupdate')->name('category_product.getupdate');
Route::post('admin/cat_product/update/{id}', 'CategoryProductController@update')->name('category_product.update');
Route::get('admin/cat_product/delete/{id}', 'CategoryProductController@delete')->name('category_product.delete');


// product
Route::get('admin/product/list', 'ProductController@show');
Route::get('admin/product/add', 'ProductController@add');
Route::post('admin/product/list', 'ProductController@show');
Route::post('admin/product/store', 'ProductController@store');
Route::get('admin/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('admin/product/update/{id}', 'ProductController@update')->name('product.update');
Route::get('admin/product/delete/{id}', 'ProductController@delete')->name('product.delete');

//productImage
Route::get('admin/productImage/list/{id}', 'ProductImageController@show')->name('product.image');
Route::get('admin/productImage/edit/{id}', 'ProductImageController@edit');
Route::get('admin/productImage/delete/{id}','ProductImageController@delete')->name('productImage.delete');


//category_posts
Route::get('admin/cat_post/list', 'CategoryPostController@show');
Route::post('admin/cat_post/add', 'CategoryPostController@add');
Route::get('admin/cat_post/update/{id}', 'CategoryPostController@update')->name('categoryPost.update');
Route::post('admin/cat_post/store/{id}', 'CategoryPostController@store')->name('categoryPost.store');
Route::get('admin/cat_post/delete/{id}', 'CategoryPostController@delete')->name('categoryPost.delete');

//posts
Route::get('admin/post/list', 'PostController@show');
Route::get('admin/post/add', 'PostController@add');
Route::post('admin/post/store', 'PostController@store');


// Order
Route::get('admin/order/list', 'AdminOrderController@show')->name('order.index');
Route::post('admin/order/create', 'AdminOrderController@create')->name('order.add');
Route::get('admin/order/detail/{id}', 'AdminOrderController@detail')->name('order.detail');
Route::post('admin/order/detail/{id}', 'AdminOrderController@update');
Route::get('admin/order/delete/{id}', 'AdminOrderController@delete')->name('order.delete');

//Route::get('admin/test', 'AdminOrderController@ok');


//admin user

Route::get('admin/user/list', 'AdminUserController@show')->name('user.index');
Route::get('admin/user/add', 'AdminUserController@add')->name('user.add');
Route::post('admin/user/store', 'AdminUserController@store')->name('user.store');
Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user.edit');
Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.update');
Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('user.delete');
Route::get('admin/user/test', 'AdminUserController@test')->name('user.test');

//slider
Route::get('admin/slider/list', 'AdminSliderController@show');
Route::post('admin/slider/add', 'AdminSliderController@add');
Route::get('admin/slider/delete/{id}', 'AdminSliderController@delete')->name('slider.delete');

//HOME
Route::get('/', 'UserHomeController@index')->name('home');
Route::get('detail/list/{id}','UserProductController@detailProduct')->name('detail.product');

//user profile
Route::get('profile', 'UserProfileController@index')->name('profile.index');
Route::get('profile/store', 'UserProfileController@store')->name('profile.store');
Route::post('profile/update', 'UserProfileController@update')->name('profile.update');
Route::get('logout', 'UserProfileController@logout')->name('profile.logout');

//user product
Route::post('check', 'UserProductController@check')->name('check.test');
Route::get('product/{id}', 'UserProductController@show')->name('product.show');
Route::get('product', 'UserProductController@search')->name('product.search');
Route::get('check/{id}', 'UserProductController@check');

//post
Route::get('post', 'UserPostController@show')->name('post.index');
Route::get('post/{slug}', 'UserPostController@detailPost')->name('detailPost.index');


//checkout
Route::post('checkout', 'UserCheckOutController@show')->name('checkout.index');
Route::get('delete','UserCheckOutController@delete')->name('checkout.delete');
Route::get('show','UserCheckOutController@index')->name('checkout.show');
// cart
Route::get('gio-hang', 'UserCartController@show')->name('cart.index');
Route::get('cart/add/{id}', 'UserCartController@add')->name('cart.add');
Route::get('cart/delete/{rowId}', 'UserCartController@delete')->name('cart.delete');
Route::get('cart/update', 'UserCartController@update')->name('cart.update');
Route::get('cart/ajax', 'UserCartController@ajax')->name('cart.ajax');
Route::get('cart/destroy', 'UserCartController@destroy')->name('cart.destroy');

//permission
Route::get('admin/permission/add', 'PermissionController@add')->name('permission.add');
Route::get('admin/permission/delete/{id}', 'PermissionController@delete')->name('permission.delete');

Route::get('admin/permission/create', 'PermissionController@create')->name('permission.create');
Route::post('admin/permission/store', 'PermissionController@store')->name('permission.store');

//roles
Route::get('admin/role/index', 'RoleController@index')->name('role.index');
Route::get('admin/role/add', 'RoleController@add')->name('role.add')->middleware('can:role.add');
Route::post('admin/role/store', 'RoleController@store')->name('role.store');
Route::get('admin/role/edit/{role}', 'RoleController@edit')->name('role.edit');
Route::post('admin/role/update/{role}', 'RoleController@update')->name('role.update');
Route::get('admin/role/delete/{role}', 'RoleController@delete')->name('role.delete');
