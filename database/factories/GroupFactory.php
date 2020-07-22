<?php

use App\Models\Department;
use App\Models\Group;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Group::class, function (Faker $faker) {
    return [
        'title' =>  random_int(100,999) . '-' . random_int(100,999),
        'specialty' => $faker->word,
        'specialization' => $faker->word,
        'study_program' => $faker->word,
        'study_period' => (random_int(12,50) % 12) * 12,
        'study_form' => $faker->word,
        'start_year' => $faker->year,

        'department_id' => function () {
            return Department::all()->random()->first()->id;
        },
    ];
});
