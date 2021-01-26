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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Statuses Comments routes
Route::post('statuses/{status}/comments', [App\Http\Controllers\StatusCommentController::class, 'store'])->name('statuses.comments.store')->middleware('auth') ;
