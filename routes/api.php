<?php

use Illuminate\Support\Facades\Route;

Route::domain('{user}.' . config('app.domain'))->group(function () {
    Route::fallback(\App\Http\Controllers\Endpoint\ShowController::class);
});

Route::group([
    'prefix' => 'api/',
], function () {
   Route::fallback(\App\Http\Controllers\Endpoint\ShowController::class);
});
