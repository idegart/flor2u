<?php

namespace App\Services\Weather;

use GuzzleHttp\Client;

class YaWeather implements WeatherInterface
{
    private const BASE_URL = 'https://api.weather.yandex.ru/v1/';

    private $apiKey;

    private $apiClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->apiClient = new Client([
            'base_uri' => self::BASE_URL,
        ]);
    }

    public function getFactByCoords(float $lat, float $lon): ?int
    {
        $response = $this->doRequest([
            'lat' => $lat, // широта
            'lon' => $lon, // долгота
        ]);

        return $response['temp'] ?? null;
    }

    private function doRequest(array $query)
    {
        $response = $this->apiClient->get('fact', [
            'headers' => [
                'X-Yandex-API-Key' => $this->apiKey,
            ],
            'query' => $query
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
