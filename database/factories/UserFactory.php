<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, static function (Faker $faker) {
    return [
        'login' => $faker->userName . random_int(100,1000),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'middle_name' => random_int(0, 100) < 20 ? $faker->middleName : null,
        'email' => $faker->email,
        'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'phone' => $faker->phoneNumber,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'about' => random_int(0, 100) < 40 ? $faker->realText() : null,
    ];
});
