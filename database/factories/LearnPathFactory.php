<?php

/** @var Factory $factory */

use App\LearnPath;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(LearnPath::class, function (Faker $faker) {

    $title = '';
    for ($i = 0; $i < rand(2, 3); $i++) {
        $title .= $faker->name . ' ';
    }

    $titleEng = '';
    for ($i = 0; $i < rand(2, 3); $i++) {
        $titleEng .= $faker->userName . ' ';
    }

    $description = '';
    for ($i = 0; $i < rand(15, 40); $i++) {
        $description .= $faker->name . ' ';
    }

    $descriptionEng = '';
    for ($i = 0; $i < rand(15, 40); $i++) {
        $descriptionEng .= $faker->userName . ' ';
    }

    return [
        'title' => $title,
        'titleEng' => $titleEng,
        'description' => $description,
        'descriptionEng' => $descriptionEng,
        'price' => rand(1000, 5000),
        'priceOffPercent' => rand(10, 20),
//        'img' => $faker->image(public_path('learn paths/'), 480, 270, null, false),
    ];
});
