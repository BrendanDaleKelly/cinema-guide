<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        $this->call(CinemasTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
