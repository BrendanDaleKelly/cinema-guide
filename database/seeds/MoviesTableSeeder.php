<?php

use Illuminate\Database\Seeder;
use App\Movie;

class MoviesTableSeeder extends Seeder
{
    // Delete everything from the movies table then insert faker data with the movie factory.
    public function run()
    {
        Movie::truncate();
        factory(App\Movie::class, 40)->create();
    }
}
