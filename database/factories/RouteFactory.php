<?php

use Faker\Generator as Faker;

$factory->define(\App\Route::class, function (Faker $faker) {
    return [
        'total_time' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999998),
        'total_distance' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 99999),
        'average_speed' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 999999)
    ];
});
