<?php

use App\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Student::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\Models\User::class, 1)->create()->id;
        },
        'group_id' => function () {
            return \App\Models\Group::all()->random()->first()->id;
        },
        'sex' => $faker->boolean,
        'student_code' => 'БС2-'.(string) random_int(10000, 99999),
        'status' => (random_int(0, 100) < 30) ? (random_int(0, 100) < 25) ? 'Отчислен' : 'Закончил обучение' : 'Учится',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
