<?php

use Illuminate\Database\Seeder;
use App\Cinema;

class CinemasTableSeeder extends Seeder
{
    // Delete everything from the cinemas table then insert faker data with the cinema factory.
    public function run()
    {
        Cinema::truncate();
        factory(App\Cinema::class, 10)->create();
    }
}
