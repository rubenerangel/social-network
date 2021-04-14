<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatusLikesController;

Route::view('/', 'welcome');

// Statuses routes
Route::get('statuses', [StatusController::class, 'index'])
  ->name('statuses.index');
Route::post('statuses', [StatusController::class, 'store'])
  ->name('statuses.store')
  ->middleware(['auth']);

// Statuses Likes routes
Route::post('statuses/{status}/likes', [StatusLikesController::class, 'store'])->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes', [StatusLikesController::class, 'destroy'])->name('statuses.likes.destroy')->middleware('auth');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard'); */


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Statuses Comments routes
Route::post('statuses/{status}/comments', [App\Http\Controllers\StatusCommentController::class, 'store'])->name('statuses.comments.store')->middleware('auth') ;

// Comments Likes routes
Route::post('comments/{comment}/likes', [App\Http\Controllers\CommentLikesController::class, 'store'])->name('comments.likes.store')->middleware('auth');

Route::delete('comments/{comment}/likes', [App\Http\Controllers\CommentLikesController::class, 'destroy'])->name('comments.likes.destroy')->middleware('auth');

// Users routes
Route::get('@{user}', [App\Http\Controllers\UsersController::class, 'show'])->name('users.show');

// Users statuses routes
Route::get('users/{user}/statuses',[App\Http\Controllers\UsersStatusController::class, 'index'])->name('users.statuses.index');

// Freindships routes
Route::post('friendships/{recipient}', [App\Http\Controllers\FriendshipsController::class, 'store'])->name('friendships.store')->middleware('auth');
Route::delete('friendships/{recipient}', [App\Http\Controllers\FriendshipsController::class, 'destroy'])->name('friendships.destroy')->middleware('auth');

// Accept Freindships routes
Route::post('accept-friendships/{sender}', [App\Http\Controllers\AcceptFriendshipsController::class, 'store'])->name('accept-friendships.store')->middleware('auth');
Route::delete('accept-friendships/{sender}', [App\Http\Controllers\AcceptFriendshipsController::class, 'destroy'])->name('accept-friendships.destroy')->middleware('auth');

Auth::routes();
