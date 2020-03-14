<?php

namespace App\Services\Weather;

interface WeatherInterface
{
    public function __construct(string $apiKey);

    public function getFactByCoords(float $lat, float $lon): ?int;
}
