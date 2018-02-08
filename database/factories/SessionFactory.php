<?php

use Faker\Generator as Faker;

$factory->define(App\Session::class, function (Faker $faker) {
    return [
        'movie_id' => $faker->numberBetween($min = 1, $max = 50),
        'cinema_id' => $faker->numberBetween($min = 1, $max = 200),
        'time' => $faker->dateTime($min = 'now', $timezone = NULL),
    ];
});
