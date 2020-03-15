<?php

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $limit = 20;

        for ($i = 0; $i < $limit; $i++) {
            Partner::forceCreate([
                'email' => $faker->unique()->email,
                'name' => $faker->unique()->company,
            ]);
        }
    }
}
