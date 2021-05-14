<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CoursePart;
use Faker\Generator as Faker;

$factory->define(CoursePart::class, function (Faker $faker) {

    return [
        'title' => $faker->name,
        'path' => '',
        'durationHours' => rand(0, 1),
        'durationMinutes' => rand(1, 10),
        'durationSeconds' => rand(1, 59),
    ];
});
