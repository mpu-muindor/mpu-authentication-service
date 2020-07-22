<?php

use App\Models\Professor;
use App\Models\User;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Professor::class, function (Faker $faker) {
    return [
        'location' => 'A-' . (random_int(1,5) * 100 + random_int(10,40)),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
