<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index')->name('index');
Route::get('/category/{id}', 'HomeController@category')->name('category');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/show/{id}', 'HomeController@show')->name('show');
Route::post('/add-cart', 'HomeController@addCart')->name('addCart');
Route::get('/cart', 'HomeController@cart')->name('cart');
Route::post('/order', 'HomeController@order')->name('order');
Route::get('/destroy-cart', 'HomeController@destroyCart')->name('destroyCart');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect(route('admin.login'));
    });

    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login-process', 'AuthController@loginProcess')->name('loginProcess');
    Route::get('/register', 'AuthController@register')->name('register');
    Route::post('/register-process', 'AuthController@registerProcess')->name('registerProcess');
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('/show/{id}', 'UserController@show')->name('show');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::put('/update/{id}', 'UserController@update')->name('update');
        Route::delete('/delete/{id}', 'UserController@delete')->name('delete');

    });

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/data', 'CategoryController@data')->name('data');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/store', 'CategoryController@store')->name('store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
        Route::put('/update/{id}', 'CategoryController@update')->name('update');
        Route::delete('/delete/{id}', 'CategoryController@delete')->name('delete');
        Route::get('/trash', 'CategoryController@trash')->name('trash');
        Route::get('/restore/{id}', 'CategoryController@restore')->name('restore');
        Route::delete('/force-delete/{id}', 'CategoryController@forceDelete')->name('forceDelete');

    });

    Route::prefix('/items')->name('items.')->group(function () {
        Route::get('/', 'ItemController@index')->name('index');
        Route::get('/create', 'ItemController@create')->name('create');
        Route::get('/createDetail', 'ItemController@createDetail')->name('createDetail');
        Route::post('/store', 'ItemController@store')->name('store');
        Route::get('/detail/{id}', 'ItemController@detail')->name('detail');
        Route::get('/edit-item/{id}', 'ItemController@editItem')->name('editItem');
        Route::get('/edit-detail/{id}', 'ItemController@editDetail')->name('editDetail');
        Route::get('/edit-option/{id}', 'ItemController@editOption')->name('editOption');
        Route::post('/edit-detail-option/{id}', 'ItemController@editDetailOption')->name('editDetailOption');
        Route::put('/update-item/{id}', 'ItemController@updateItem')->name('updateItem');
        Route::put('/update-detail/{id}', 'ItemController@updateDetail')->name('updateDetail');
        Route::put('/update-option/{id}', 'ItemController@updateOption')->name('updateOption');
        Route::put('/update-detail-option/{id}', 'ItemController@updateDetailOption')->name('updateDetailOption');
        Route::put('/update/{id}', 'ItemController@update')->name('update');
        Route::delete('/delete/{id}', 'ItemController@delete')->name('delete');
        Route::get('/trash', 'ItemController@trash')->name('trash');
        Route::get('/restore/{id}', 'ItemController@restore')->name('restore');
        Route::delete('/force-delete/{id}', 'ItemController@forceDelete')->name('forceDelete');
    });

    Route::prefix('/variants')->name('variants.')->group(function () {
        Route::get('/', 'VariantController@index')->name('index');
        Route::get('/create', 'VariantController@create')->name('create');
        Route::post('/store', 'VariantController@store')->name('store');
        Route::get('/edit/{id}', 'VariantController@edit')->name('edit');
        Route::put('/update/{id}', 'VariantController@update')->name('update');
        Route::delete('/delete/{id}', 'VariantController@delete')->name('delete');
    });

    Route::prefix('/sizes')->name('sizes.')->group(function () {
        Route::get('/', 'SizeController@index')->name('index');
        Route::get('/create', 'SizeController@create')->name('create');
        Route::post('/store', 'SizeController@store')->name('store');
        Route::get('/edit/{id}', 'SizeController@edit')->name('edit');
        Route::put('/update/{id}', 'SizeController@update')->name('update');
        Route::delete('/delete/{id}', 'SizeController@delete')->name('delete');
    });

    Route::prefix('/ingredients')->name('ingredients.')->group(function () {
        Route::get('/', 'IngredientController@index')->name('index');
        Route::get('/create', 'IngredientController@create')->name('create');
        Route::post('/store', 'IngredientController@store')->name('store');
        Route::get('/edit/{id}', 'IngredientController@edit')->name('edit');
        Route::put('/update/{id}', 'IngredientController@update')->name('update');
        Route::delete('/delete/{id}', 'IngredientController@delete')->name('delete');
    });

    Route::prefix('/orders')->name('orders.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/detail/{id}', 'OrderController@detail')->name('detail');
        Route::get('/create', 'OrderController@create')->name('create');
        Route::post('/store', 'OrderController@store')->name('store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
        Route::put('/update/{id}', 'OrderController@update')->name('update');
        Route::delete('/delete/{id}', 'OrderController@delete')->name('delete');
    });

});
