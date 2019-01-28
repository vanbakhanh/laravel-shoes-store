<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'product_id' => App\Models\Product::all()->random()->id,
        'user_id' => App\Models\User::all()->random()->id,
    ];
});
