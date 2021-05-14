<?php

/** @var Factory $factory */

use App\Library;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Library::class, function (Faker $faker) {
    return [
        'title' => $faker->name . ' ' . $faker->name,
    ];
});
