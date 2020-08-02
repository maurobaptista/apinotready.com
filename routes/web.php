<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Endpoint\CreateController::class);
Route::post('/endpoints', App\Http\Controllers\Endpoint\StoreController::class);
