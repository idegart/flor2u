<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class OrdersProductsTableSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        Order::chunkById(100, static function (Collection $orders) {
            $orders->each(static function (Order $order) {
                $products = Product::inRandomOrder()->limit(random_int(1, 4))->get();

                $products->each(static function (Product $product) use ($order) {
                    $order->products()->attach($product, [
                        'quantity' => random_int(1, 3),
                        'price' => $product->price,
                        'created_at' => $order->created_at,
                        'updated_at' => $order->updated_at,
                    ]);
                });
            });
        });
    }
}
