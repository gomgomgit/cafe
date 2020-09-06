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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->name('admin.')->group(function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/data', 'CategoryController@data')->name('data');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/store', 'CategoryController@store')->name('store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
        Route::put('/update/{id}', 'CategoryController@update')->name('update');
        Route::delete('/delete/{id}', 'CategoryController@delete')->name('delete');

    });

    Route::prefix('/items')->name('items.')->group(function () {
        Route::get('/', 'ItemController@index')->name('index');
        Route::get('/create', 'ItemController@create')->name('create');
        Route::post('/createDetail', 'ItemController@createDetail')->name('createDetail');
        Route::post('/store', 'ItemController@store')->name('store');
        Route::get('/edit/{id}', 'ItemController@edit')->name('edit');
        Route::put('/update/{id}', 'ItemController@update')->name('update');
        Route::delete('/delete/{id}', 'ItemController@delete')->name('delete');
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
        Route::get('/create', 'OrderController@create')->name('create');
        Route::post('/store', 'OrderController@store')->name('store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
        Route::put('/update/{id}', 'OrderController@update')->name('update');
        Route::delete('/delete/{id}', 'OrderController@delete')->name('delete');
    });

});
