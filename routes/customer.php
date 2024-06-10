<?php

use App\Http\Controllers\API\Customer\V1Controller;

// Customer API routes
Route::group(['prefix' => 'customer'], function () {
    Route::post('register', [V1Controller::class, 'register']);
    Route::post('login', [V1Controller::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [V1Controller::class, 'logout']);
    });
});


