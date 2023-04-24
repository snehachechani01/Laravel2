<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;


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

//Route::get('/', function () {
//    return view('login');
//});
//
//Route::resource('books', BookController::class);
//Route::get('/books', [BookController::class, 'index'])->name('books.index');
//Route::get('/books/search', [BookController::class, 'search'])->name('books.search');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login')->middleware('throttle:2,1');

    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('throttle:2,1');
});



Route::group(['middleware' => 'auth'], function () {

     Route::resource('/books', BookController::class);
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    // Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
//    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
