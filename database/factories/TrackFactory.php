<?php

use Faker\Generator as Faker;

$factory->define(\App\Track::class, function (Faker $faker) {
    return [
        'latitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = -90, $max = 90),
        'longitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = -180, $max = 180),
        'speed' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 300)
    ];
});
