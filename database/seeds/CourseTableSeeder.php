<?php

use App\Course;
use App\CoursePart;
use App\User;
use App\Author;
use App\Software;
use App\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($u) {
            $u->courses()
                ->saveMany(factory(Course::class, rand(50, 100))->make())
                ->each(function (Course $course) {
                    /*
                     * subjects and softwares ans authors
                     */
                    $course->subjects()->attach(Subject::all()->random(rand(1, 5)));
                    $course->softwares()->attach(Software::all()->random(rand(1, 5)));
                    $course->authors()->attach(Author::all()->random(rand(1, 3)));

                    /*
                     * course parts
                     */
                    $course_id_in_path = ($course->id % 2);
                    if ($course_id_in_path % 2 == 0)
                        $course_id_in_path = 2;
                    $course_path = 'courses/' . $course_id_in_path;
                    $previewFileName = File::allFiles(public_path($course_path . '/preview/'))[0]->getFilename();
                    $course->previewFile = $course_path . '/preview/' . $previewFileName;
                    $course->previewSubtitle = $course_path . '/preview/' . $previewFileName;

                    $imgFileName = File::allFiles(public_path($course_path . '/image/'))[0]->getFilename();
                    $course->img = $course_path . '/image/' . $imgFileName;
                    $course->partNumbers = count(File::allFiles(public_path($course_path . '/parts/')));

                    $course->save();

                    $course->course_parts()
                        ->saveMany(factory(CoursePart::class, $course->partNumbers)->make())
                        ->each(function (CoursePart $course_part) {
                            $course_id_in_path = ($course_part->course_id % 2);
                            if ($course_id_in_path % 2 == 0)
                                $course_id_in_path = 2;
                            $course_path = 'courses/' . $course_id_in_path;
                            $files = File::allFiles(public_path($course_path . '/parts/'));

                            $file_index = ($course_part->id % count($files)) - 1;
                            if ($file_index == -1)
                                $file_index = count($files) - 1;
                            sort($files, SORT_STRING);
                            $course_part->path = $course_path . '/parts/' . $files[$file_index]->getFileName();
                            $course_part->partNumber = $file_index + 1;
                            $course_part->title = $files[$file_index]->getFilename();
                            $course_part->title = substr($course_part->title, 0, -4);
                            $getID3 = new getID3;
                            $video = $getID3->analyze(public_path($course_part->path));
                            $course_part->fileType = $video['fileformat'];
                            $course_part->durationHours = date('H.v', $video['playtime_seconds']);
                            $course_part->durationMinutes = date('i.v', $video['playtime_seconds']);
                            $course_part->durationSeconds = date('s.v', $video['playtime_seconds']);
                            //                        $course_part->duration = $video['playtime_string'];
                            $course_part->save();
                        });
                });
        });
    }
}
