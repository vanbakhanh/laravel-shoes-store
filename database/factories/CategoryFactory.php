<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElements(
			['Lifestyle', 'Running', 'Gym & Training', 'Soccer', 'Tennis', 'Basketball']
		)[0],
		'description' => $faker->text($maxNbChars = 200),
	];
});
