<?php

use App\Http\Controllers\API\Driver\V1Controller;

Route::group(['prefix' => 'driver'], function () {
    Route::post('login', [V1Controller::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [V1Controller::class, 'logout']);
    });
});
