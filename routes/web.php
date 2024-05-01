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
    return view('order');
});
Route::get('/paper', 'App\Http\Controllers\PaperSupplierController@index');
Route::post('/paper', 'App\Http\Controllers\PaperSupplierController@create')->name('create_paper');
