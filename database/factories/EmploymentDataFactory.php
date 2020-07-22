<?php

use App\Models\EmploymentData;
use App\Models\Professor;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(EmploymentData::class, function (Faker $faker) {
    return [
        'department' => $faker->word,
        'position' => $faker->word,
        'multiplier' => random_int(0,100) < 50 ? 0.25 : 1,
        'created_at' => now(),
        'updated_at' => now(),

        'professor_id' => function () {
            return factory(Professor::class)->create()->id;
        },
    ];
});
