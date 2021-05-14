<?php

/** @var Factory $factory */

use App\Author;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\File;

$factory->define(Author::class, function (Faker $faker) {
    $profiles = File::allFiles(public_path('/profiles/'));
    $filename = 'default.png';
    if (count($profiles) > 0) {
        $filename = $profiles[rand(0, count($profiles) - 1)]->getFilename();
    }
    $paragraph = '';
    for ($i = 0; $i < rand(50, 60); $i++)
        $paragraph .= $faker->name . ' ';

    return [
        'name' => $faker->name,
        'img' => 'profiles/' . $filename,
        'description' => $paragraph,
//        'email' => $faker->email,
//        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
