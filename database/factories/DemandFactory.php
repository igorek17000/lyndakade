<?php

/** @var Factory $factory */

use App\Demand;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Demand::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'author' => $faker->name,
        'link' => $faker->url,
        'is_read' => rand(0, 1),
        'is_done' => rand(0, 1),
    ];
});
