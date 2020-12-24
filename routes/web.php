<?php

use App\Http\Controllers\PostController;
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

// home route
Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware('auth')->name('dashboard');


Route::get('/index', [PostController::class, 'index'])->name('post.index');
Route::get('/create', [PostController::class, 'create'])->name('post.create');
Route::post('/store', [PostController::class, 'store'])->name('post.store');

Route::get('/{id}/show', [PostController::class, 'show'])->where(['id'=>'[1-9]+'])->name('post.show');
Route::get('/{id}/edit', [PostController::class, 'edit'])->where(['id'=>'[1-9]+'])->name('post.edit');
Route::put('/{id}/update', [PostController::class, 'update'])->where(['id'=>'[1-9]+'])->name('post.update');
Route::delete('/{id}/destory', [PostController::class, 'destroy'])->where(['id'=>'[1-9]+'])->name('post.destory');