<?php

use Faker\Generator as Faker;


$factory->define(\App\Ship::class, function (Faker $faker) {
        return [
            'name' => $faker->name,
        ];

});


