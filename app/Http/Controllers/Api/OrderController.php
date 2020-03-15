<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderController extends Controller
{
    public function index(IndexRequest $request): JsonResource
    {
        $orders = Order::with(['partner', 'products'])
            ->paginate($request->getPerPage());

        return OrderResource::collection($orders);
    }
}
