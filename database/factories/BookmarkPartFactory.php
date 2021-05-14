<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookmarkPart;
use App\Course;
use Faker\Generator as Faker;

$factory->define(BookmarkPart::class, function (Faker $faker) {
    return [
        'course_id' => Course::all()->random()->id,
    ];
});
