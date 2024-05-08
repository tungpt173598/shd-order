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

Route::get('/order', 'App\Http\Controllers\OrderController@index');
Route::get('/order/{id}', 'App\Http\Controllers\OrderController@detail');
Route::post('/order', 'App\Http\Controllers\OrderController@create')->name('create_order');
Route::post('/order/{id}', 'App\Http\Controllers\OrderController@update')->name('edit_order');
Route::delete('/order/{id}', 'App\Http\Controllers\OrderController@delete')->name('delete_order');
Route::get('/paper', 'App\Http\Controllers\PaperSupplierController@index');
Route::post('/paper', 'App\Http\Controllers\PaperSupplierController@create')->name('create_paper');
Route::get('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@detail');
Route::post('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@update')->name('edit_paper');
Route::delete('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@delete')->name('edit_paper');
