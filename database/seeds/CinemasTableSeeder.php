<?php

use Illuminate\Database\Seeder;
use App\Cinemas;

class CinemasTableSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        Cinemas::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 15; $i++) {
            Cinemas::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'url' => $faker->url,
                'phone' => $faker->phoneNumber,
                'latitude' => $faker->randomFloat($nbMaxDecimals = 6, $min = -90, $max = 90),
                'longitude' => $faker->randomFloat($nbMaxDecimals = 6, $min = -180, $max = 180),
            ]);
        }
    }
}
