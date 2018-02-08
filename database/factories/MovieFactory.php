<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 20, $indexSize = 2),
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'poster' => $faker->url,
        'trailer' => $faker->url,
    ];
});
