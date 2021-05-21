<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;

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

// Route::get('/', function () {
//      return view('welcome');
// });

// the user profile
Route::get('/dashboard', [DashboardController::class, 'profile'])->middleware('auth')->name('dashboard');


Route::get('/profile', [PageController::class, 'profile'])->middleware('auth')->name('profile');


Route::group(['middleware' => ['auth']], function () {
    
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post/store', [PostController::class, 'store'])->name('post.store');

});

Route::prefix('/post')->name('post.')->group(function() {



        Route::get('/{post}/show', [PostController::class, 'show'])->name('show');
       
        Route::group(['middleware' => ['auth']], function () {
            
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::put('/{post}/update', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}/destory', [PostController::class, 'destroy'])->name('destory');
            
        });

});

Route::get('/comment/{comment}/index', [CommentController::class, 'index'])->name('comment.index');
Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');

Route::prefix('/comment/{comment}')->name('comment.')->group(function () {
    
    Route::delete('/destory', [CommentController::class, 'destory'])->name('destory');
    Route::put('/update', [CommentController::class, 'update'])->name('update');

});


Route::prefix('/users/')->name('user.')->group(function () {

    Route::post('/{user}/update', [UserController::class, 'update'])->name('update')->middleware(['auth']);
});

// admin routes
Route::prefix('/admin/dashboard')->name("admin.")->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});