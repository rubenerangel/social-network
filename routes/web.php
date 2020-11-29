<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;

Route::post('statuses', [StatusController::class, 'store'])
  ->name('statuses.store');
