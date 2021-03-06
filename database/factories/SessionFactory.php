<?php

use Faker\Generator as Faker;

$factory->define(App\Session::class, function (Faker $faker) {
    return [
        'movie_id' => $faker->numberBetween($min = 1, $max = 40),
        'cinema_id' => $faker->numberBetween($min = 1, $max = 80),
        'date' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
        'time' => $faker->time(),
    ];
});
