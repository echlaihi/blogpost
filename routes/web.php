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



##########################
## dashboard routes  #####
##########################

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/notifications', [DashboardController::class, 'listNotifications'])->middleware('auth')->name('notifications.list');
Route::get('/dashboard/notification/{id}/read', [DashboardController::class, 'readNotification'])->middleware('auth')->name('notification.read');
Route::get('/dashoard/posts', [PostController::class, 'list'])->middleware(['auth', 'admin'])->name('dashboard.posts');
Route::get('/dashboard/users', [UserController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard.users');



#########################
#### post routes   ######
#########################

Route::get('/', [PostController::class, 'index'])->name('post.index');

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


#####################
## comment routes ####
#####################
Route::get('/comment/{comment}/index', [CommentController::class, 'index'])->name('comment.index');

Route::prefix('/comment/{comment}')->name('comment.')->group( function () {
    
    Route::delete('/destory', [CommentController::class, 'destory'])->name('destory');
    Route::put('/update', [CommentController::class, 'update'])->name('update');

});


// routes for updating users
Route::prefix('/users/')->name('user.')->group( function () {

    Route::post('/{user}/update', [UserController::class, 'update'])->name('update')->middleware(['auth']);
});

