<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bookmark;
use App\User;
use App\Course;
use Faker\Generator as Faker;

$factory->define(Bookmark::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'partNumbers' => rand(2, 5),
    ];
});
