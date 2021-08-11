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

Route::any('posts/search', [\App\Http\Controllers\PostController::class, 'search'])->name('posts.search')->middleware(['auth']);
Route::resource('posts', \App\Http\Controllers\PostController::class)->middleware(['auth']);
Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
