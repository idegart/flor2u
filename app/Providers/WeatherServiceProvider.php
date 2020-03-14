<?php

namespace App\Providers;

use App\Services\Weather\WeatherInterface;
use App\Services\Weather\YaWeather;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherInterface::class, static function (Application $app) {
            return new YaWeather(config('services.ya_weather.key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
