<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\WeatherController;

Route::get('weather', [WeatherController::class, 'index']);

Route::get('partners', [PartnerController::class, 'index']);

Route::prefix('orders')->group(static function () {
    Route::get('', [OrderController::class, 'index']);
    Route::get('{order}', [OrderController::class, 'show']);
    Route::post('{order}', [OrderController::class, 'update']);
});
