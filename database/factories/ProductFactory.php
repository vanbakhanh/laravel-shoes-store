<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
	$gender = $faker->randomElements(['male', 'female'])[0];
	return [
		'name' => $faker->unique()->word,
		'price' => $faker->numberBetween($min = 10, $max = 200),
		'gender' => $gender,
		'description' => $faker->text($maxNbChars = 200),
		'image' => 'product' . $faker->numberBetween($min = 1, $max = 15) . '.jpg',
		'category_id' => App\Models\Category::all()->random()->id,
	];
});
