<?php

use Faker\Generator as Faker;

$factory->define('App\Models\Review', function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body' => $faker->text($maxNbChars = 200),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'product_id' => App\Models\Product::all()->random()->id,
        'user_id' => App\Models\User::all()->random()->id,
    ];
});
