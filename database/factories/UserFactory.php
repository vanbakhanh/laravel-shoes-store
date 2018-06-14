<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
	$gender = $faker->randomElements(['male', 'female'])[0];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $gender,
        'status' => '1',
        'token' => str_random(60),
    ];
});
