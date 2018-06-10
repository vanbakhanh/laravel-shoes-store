<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
	$name = $faker->unique()->randomElements(['Lifestyle', 'Running', 'Gym & Training', 'Soccer', 'Tennis', 'Basketball'])[0];
    return [
        'name' => $name,
        'description' => $faker->text($maxNbChars = 200),
    ];
});
