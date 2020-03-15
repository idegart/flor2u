<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderController extends Controller
{
    public function index(IndexRequest $request): JsonResource
    {
        $ordersQuery = Order::with(['partner', 'products']);

        $orders = $request->isAll()
            ? $ordersQuery->get()
            : $ordersQuery->paginate($request->getPerPage());

        return OrderResource::collection($orders);
    }

    public function show(Order $order): JsonResource
    {
        return new OrderResource($order->load('products'));
    }

    public function update(UpdateRequest $request, Order $order): JsonResponse
    {
        return response()->json([
            'success' => $order->update($request->validated())
        ]);
    }
}
