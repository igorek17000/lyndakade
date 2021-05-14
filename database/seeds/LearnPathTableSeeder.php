<?php

use App\Course;
use App\LearnPath;
use App\Library;
use Illuminate\Database\Seeder;

class LearnPathTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Library::all() as $library) {
            $library->paths()
                ->saveMany(factory(LearnPath::class, rand(5, 10))->make([
                    'img' => 'courses/1/image/1.jpg'
                ]))
                ->each(function (LearnPath $l) {
                    $l->courses()->attach(Course::all()->random(rand(5, 10)));
                    $l->save();
                });
            $library->save();
        }
    }
}
