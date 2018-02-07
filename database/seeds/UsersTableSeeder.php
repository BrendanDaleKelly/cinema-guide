<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('password');

        User::create([
            'name' => 'Admin',
            'email' => 'brendan@pion.com.au',
            'password' => $password,
        ]);
    }
}
