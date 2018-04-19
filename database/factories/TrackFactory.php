<?php

use Faker\Generator as Faker;

$factory->define(\App\Track::class, function (Faker $faker) {
    return [
        'latitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 2),
        'longitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
        'speed' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 300)
    ];
});
