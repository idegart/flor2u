<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WeatherController;

Route::get('weather', [WeatherController::class, 'index']);

Route::prefix('orders')->group(static function () {
    Route::get('', [OrderController::class, 'index']);
});
