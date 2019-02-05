<?php

use Faker\Generator as Faker;

$factory->define('App\Models\Profile', function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'avatar' => $faker->imageUrl($width = 480, $height = 480),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => rand(0, 1),
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
    ];
});
