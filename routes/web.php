<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;

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


Route::get('/login', function () { //Вход
    return view('login');
})->name('login');
Route::get('/logup', function () { //Регистрация
    return view('logup');
});
Route::post('add/user', [UserController::class, 'logup']);
Route::post('login/user', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('post');
    });
    Route::get('profile/{id}', [UserController::class, 'profile']);
    Route::get('like/{id}', [LikeController::class, 'like']);
    Route::get('follow', [UserController::class, 'search']);
    Route::get('profile/edit/{id}', [UserController::class, 'profile_edit']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('profile/update', [UserController::class, 'update']);
    Route::post('profile/password-update', [UserController::class, 'password_update']);

    Route::post('comment/{id}', [CommentController::class, 'new_comment']);
    Route::get('comment/edit/{id}', [CommentController::class, 'edit']);
    Route::put('comment/update/{id}', [CommentController::class, 'update']);
    Route::delete('comment/delete/{id}', [CommentController::class, 'delete']);

    Route::resource('post', PostController::class);
    Route::get('post/edit/{id}', [PostController::class, 'edit']);

});
