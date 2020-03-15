<?php

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 30;

        for ($i = 1; $i <= $limit; $i++) {
            Product::forceCreate([
                'name' => 'Product_' . $i,
                'price' => $faker->numberBetween(100, 1000),
                'vendor_id' => Vendor::inRandomOrder()->limit(1)->first()->getKey(),
            ]);
        }
    }
}
