<?php

use Illuminate\Database\Seeder;
use App\Movies;

class MoviesTableSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        Movies::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Movies::create([
                'title' => $faker->realText($maxNbChars = 20, $indexSize = 2),
                'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'poster' => $faker->url,
                'trailer' => $faker->url,
            ]);
        }
    }
}
