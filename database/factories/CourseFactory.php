<?php

/** @var Factory $factory */

use App\Course;
use App\Library;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(Course::class, function (Faker $faker) {
    $title = '';

    for ($i = 0; $i < rand(2, 3); $i++) {
        $title .= $faker->name . ' ';
    }

    $titleEng = '';

    for ($i = 0; $i < rand(2, 3); $i++) {
        $titleEng .= $faker->userName . ' ';
    }

    $description = '';
    for ($i = 0; $i < rand(50, 100); $i++) {
        $description .= $faker->name . ' ';
    }

    $descriptionEng = '';
    for ($i = 0; $i < rand(50, 100); $i++) {
        $descriptionEng .= $faker->userName . ' ';
    }

    return [
        'title' => $title,
        'titleEng' => $titleEng,
        'description' => $description,
        'descriptionEng' => $descriptionEng,
        'releaseDate' => $faker->dateTimeBetween('-2 years', 'now'),
//        'author' => App\User::pluck('name')->random(),
        'durationHours' => rand(0, 6),
        'durationMinutes' => rand(10, 40),
//        'views' => 0,
        'price' => rand(0, 5) * 1000,
        'priceOffPercent' => rand(10, 20),
        'views' => rand(1, 5000000),
        'skillLevel' => rand(1, 3),
        'partNumbers' => rand(1, 3),
        'created_at' => $faker->dateTimeBetween('-1 months', 'now'),
        'library_id' => Library::all()->random()->id,
//        'img' => 'courses-images/' . rand(1, 3) . '.jpg',
//        'img' => $faker->image(public_path('courses/'), 480, 270, null, false),
    ];
});
