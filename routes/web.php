<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->to('order');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/order', 'App\Http\Controllers\OrderController@create')->name('create_order');
    Route::post('/order/{id}', 'App\Http\Controllers\OrderController@update')->name('edit_order');
    Route::delete('/order/{id}', 'App\Http\Controllers\OrderController@delete')->name('delete_order');
    Route::post('/paper', 'App\Http\Controllers\PaperSupplierController@create')->name('create_paper');
    Route::post('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@update')->name('edit_paper');
    Route::delete('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@delete')->name('edit_paper');
});
Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('order');
Route::get('/order/{id}', 'App\Http\Controllers\OrderController@detail');
Route::get('/paper', 'App\Http\Controllers\PaperSupplierController@index');
Route::get('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@detail');
Route::get('/load-price-views', [\App\Http\Controllers\ViewsController::class, 'index'])->name('load.price.views');

require __DIR__.'/auth.php';
