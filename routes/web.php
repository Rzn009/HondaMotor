<?php

use App\Http\Controllers\HondaController;
use App\Http\Controllers\ProductController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/honda' , HondaController::class);
Route::resource('/product' , ProductController::class);


Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    // for admin
    Route::middleware(['auth','admin'])->group(function()  {
        Route::resource('honda', HondaController::class);
        Route::resource('product', ProductController::class);

    });
});
