<?php

use App\LearnPath;
use App\Library;
use App\Software;
use App\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LibraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $libraries = [
            [
                "id" => "",
                "slug" => "",
                "title" => "ویدئو",
                "titleEng" => "Video",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "عکاسی",
                "titleEng" => "Photography",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "وب",
                "titleEng" => "Web",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "فناوری اطلاعات",
                "titleEng" => "IT",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "برنامه نویسی و توسعه",
                "titleEng" => "Developer",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "طراحی",
                "titleEng" => "Design",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "کسب و کار",
                "titleEng" => "Business",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "بازاریابی",
                "titleEng" => "Marketing",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "آموزش و یادگیری الکترونیکی",
                "titleEng" => "Education + Elearning",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "طراحی مهندسی",
                "titleEng" => "CAD",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "صوت و موسیقی",
                "titleEng" => "Audio + Music",
            ],
            [
                "id" => "",
                "slug" => "",
                "title" => "سه بعدی سازی و انیمیشن",
                "titleEng" => "3D + Animation",
            ],
        ];

        function cmp($a, $b)
        {
            return strcmp($a["titleEng"], $b["titleEng"]);
        }

        usort($libraries, "cmp");

        foreach ($libraries as $library) {
            $lib = new Library();
            $lib->title = $library['title'];
            $lib->titleEng = $library['titleEng'];
//            $lib->slug = Str::slug($library['slug']);
            $lib->save();
        }
    }
}
