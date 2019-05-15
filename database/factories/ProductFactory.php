<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => 'Nike ' . $faker->word . ' ' . $faker->lexify('???'),
        'price' => $faker->numberBetween($min = 10, $max = 200),
        'gender' => rand(0, 1),
        'description' => $faker->text($maxNbChars = 200),
        'image' => json_encode([
            'product' . $faker->numberBetween($min = 1, $max = 15) . '.jpg',
            'product' . $faker->numberBetween($min = 1, $max = 15) . '.jpg',
            'product' . $faker->numberBetween($min = 1, $max = 15) . '.jpg',
        ]),
        'category_id' => App\Models\Category::all()->random()->id,
    ];
});
