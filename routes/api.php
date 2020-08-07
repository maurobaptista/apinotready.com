<?php

use Illuminate\Support\Facades\Route;

Route::domain('api.' . config('app.domain'))->group(function () {
    Route::fallback(\App\Http\Controllers\Endpoint\ShowController::class);
});

Route::domain('{user}.' . config('app.domain'))->group(function () {
    Route::fallback(\App\Http\Controllers\Endpoint\ShowController::class);
});
