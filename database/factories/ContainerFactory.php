<?php

use Faker\Generator as Faker;

$factory->define(\App\Container::class, function (Faker $faker) {
    $rand = random_int(1, 3);
    return [
        'name' => $faker->name,
        'status' => $rand,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 999999)
    ];
});
