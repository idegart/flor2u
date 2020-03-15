<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Weather\IndexRequest;
use App\Services\Weather\WeatherInterface;

class WeatherController extends Controller
{
    public function index(IndexRequest $request, WeatherInterface $weatherService)
    {
        $temp = $weatherService->getFactByCoords($request->getLat(), $request->getLon());

        return response()->json(compact('temp'));
    }
}
