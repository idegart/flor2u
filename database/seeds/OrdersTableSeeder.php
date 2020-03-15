<?php

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 1000;
        $status = [0, 10, 20];

        for ($i = 0; $i < $limit; $i++) {
            $createdAt = Carbon::now()->subDays($faker->numberBetween(0, 4));
            Order::forceCreate([
                'status'        => $status[$faker->numberBetween(0, 2)],
                'client_email'  => $faker->email,
                'partner_id'    => $faker->numberBetween(1, 20),
                'delivery_dt'   => $createdAt->copy()->addHours($faker->numberBetween(6, 50)),
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt->copy()->addHours($faker->numberBetween(1, 5)),
            ]);
        }
    }
}
