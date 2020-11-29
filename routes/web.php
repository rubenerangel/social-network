<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;

Auth::routes();

Route::post('statuses', [StatusController::class, 'store'])
  ->name('statuses.store')
  ->middleware('auth');
