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
    Route::delete('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@delete')->name('delete_paper');
    Route::post('/print', 'App\Http\Controllers\PrintingController@create')->name('create_print');
    Route::post('/print/{id}', 'App\Http\Controllers\PrintingController@update')->name('edit_print');
    Route::delete('/print/{id}', 'App\Http\Controllers\PrintingController@delete')->name('delete_print');
    Route::post('process', 'App\Http\Controllers\ProcessController@create')->name('create_process');
    Route::post('process/{id}', 'App\Http\Controllers\ProcessController@update')->name('update_process');
    Route::delete('process/{id}', 'App\Http\Controllers\ProcessController@delete')->name('delete_process');
    Route::post('pack', 'App\Http\Controllers\PackController@create')->name('create_pack');
    Route::post('pack/{id}', 'App\Http\Controllers\PackController@update')->name('update_pack');
    Route::delete('pack/{id}', 'App\Http\Controllers\PackController@delete')->name('delete_pack');
    Route::post('deliver', 'App\Http\Controllers\DeliverController@create')->name('create_deliver');
    Route::post('deliver/{id}', 'App\Http\Controllers\DeliverController@update')->name('update_deliver');
    Route::delete('deliver/{id}', 'App\Http\Controllers\DeliverController@delete')->name('delete_deliver');
    Route::post('mold', 'App\Http\Controllers\MoldController@create')->name('create_mold');
    Route::post('mold/{id}', 'App\Http\Controllers\MoldController@update')->name('update_mold');
    Route::delete('mold/{id}', 'App\Http\Controllers\MoldController@delete')->name('delete_mold');
});
Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('order');
Route::get('/order/{id}', 'App\Http\Controllers\OrderController@detail');
Route::get('/paper', 'App\Http\Controllers\PaperSupplierController@index');
Route::get('/paper/{id}', 'App\Http\Controllers\PaperSupplierController@detail');
Route::get('/print', 'App\Http\Controllers\PrintingController@index');
Route::get('/print/{id}', 'App\Http\Controllers\PrintingController@detail');
Route::get('/process', 'App\Http\Controllers\ProcessController@index');
Route::get('/process/{id}', 'App\Http\Controllers\ProcessController@detail');
Route::get('/pack', 'App\Http\Controllers\PackController@index');
Route::get('/pack/{id}', 'App\Http\Controllers\PackController@detail');
Route::get('/deliver', 'App\Http\Controllers\DeliverController@index');
Route::get('/deliver/{id}', 'App\Http\Controllers\DeliverController@detail');
Route::get('/mold', 'App\Http\Controllers\MoldController@index');
Route::get('/mold/{id}', 'App\Http\Controllers\MoldController@detail');
Route::get('/load-price-views', [\App\Http\Controllers\ViewsController::class, 'index'])->name('load.price.views');

require __DIR__.'/auth.php';
