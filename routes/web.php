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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('admin/categories', 'CategoriesController@index');
// Route::resource('admin/categories/create', ['as' => 'admin.categories.create', 'uses' => 'CategoriesController@create']);

// Route::group([
//     'as' => 'admin.',
//     'prefix' => 'admin',
//     'middleware' => 'auth.check'
// ], function () {
//     Route::resource('categories', ['as' => 'categories']);
// });

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => 'auth.check'
], function () {
    Route::resource('categories', 'CategoriesController');
    Route::resource('products', 'ProductsController');
    Route::resource('clients', 'ClientsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('cupoms', 'CupomsController');
});
// Route::resource('admin/categories', 'CategoriesController');

Route::group([
    'as' => 'customer.',
    'prefix' => 'customer'
], function () {
    Route::get('order', ['as' => 'order.index', 'uses' => 'CheckoutController@index']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'CheckoutController@store']);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
