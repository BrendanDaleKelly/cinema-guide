<?php

use Illuminate\Database\Seeder;
use App\Sessions;

class SessionsTableSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        Sessions::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            Sessions::create([
                'movie_id' => $faker->numberBetween($min = 1, $max = 15),
                'cinema_id' => $faker->numberBetween($min = 1, $max = 20),
                'time' => $faker->dateTime($min = 'now', $timezone = NULL),
            ]);
        }
    }
}
