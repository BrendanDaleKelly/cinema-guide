<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'poster' => $faker->url,
        'trailer' => $faker->url,
    ];
});
