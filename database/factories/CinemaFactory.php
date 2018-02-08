<?php

use Faker\Generator as Faker;

$factory->define(App\Cinema::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'url' => $faker->url,
        'phone' => $faker->phoneNumber,
        'latitude' => $faker->randomFloat($nbMaxDecimals = 6, $min = -90, $max = 90),
        'longitude' => $faker->randomFloat($nbMaxDecimals = 6, $min = -180, $max = 180),
    ];
});
