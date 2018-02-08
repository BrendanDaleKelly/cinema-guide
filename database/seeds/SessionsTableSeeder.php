<?php

use Illuminate\Database\Seeder;
use App\Session;

class SessionsTableSeeder extends Seeder
{
    // Delete everything from the sessions table then insert faker data with the session factory.
    public function run()
    {
        Session::truncate();
        factory(App\Session::class, 1000)->create();
    }
}
