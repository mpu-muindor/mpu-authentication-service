<?php

use App\Models\Faculty;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
