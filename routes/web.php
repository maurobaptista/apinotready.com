<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/endpoints', App\Http\Controllers\Endpoint\StoreController::class);
