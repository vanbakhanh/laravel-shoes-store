<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Size::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->numberBetween($min = 35, $max = 45),
    ];
});
