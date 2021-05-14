<?php

use App\Bookmark;
use App\BookmarkPart;
use App\Course;
use App\User;
use Illuminate\Database\Seeder;

class BookmarkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function (User $u) {
            $u->bookmarks()
                ->saveMany(factory(Bookmark::class, rand(0, 10))->make())
                ->each(function (Bookmark $b) {
                    $courses = Course::all()->random($b->partNumbers);
                    foreach ($courses as $course) {
                        $b->bookmark_parts()->save(factory(BookmarkPart::class)->make([
                            'course_id' => $course->id,
                        ]));
                    }
                });
        });
    }
}
