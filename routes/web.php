<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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


Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');

});

Route::prefix('/post')->name('post.')->group(function() {



        Route::get('/{post}/show', [PostController::class, 'show'])->name('show');
       
        Route::group(['middleware' => ['auth']], function () {
            
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::put('/{post}/update', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}/destory', [PostController::class, 'destroy'])->name('destory');
            
        });

});

Route::get('}post}/comment/{comment}/index', [CommentController::class, 'index'])->name('comment.index');
Route::prefix('/comment/{comment}')->name('comment.')->group(function () {

    Route::post('/store', [CommentController::class, 'store'])->name('store');
    Route::delete('/destory', [CommentController::class, 'destory'])->name('destory');
    Route::put('/update', [CommentController::class, 'update'])->name('update');

});
