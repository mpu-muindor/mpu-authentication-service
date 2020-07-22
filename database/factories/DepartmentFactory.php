<?php

use App\Models\Department;
use App\Models\Faculty;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Department::class, function (Faker $faker) {
    return [
        'title' => $faker->word,

        'faculty_id' => function () {
            return Faculty::all()->random(1)->first()->id;
        },
    ];
});
