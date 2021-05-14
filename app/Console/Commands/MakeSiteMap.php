<?php

namespace App\Console\Commands;

use App\Course;
use App\Software;
use App\Subject;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'making new sitemap.xml';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $d = \Carbon\Carbon::now();
        $d_c = $d->format('Y-m-d');
        $output = '<?xml version="1.0" encoding="utf-8" standalone="no"?>
<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        function add_url($current_output, $url, $mod, $p)
        {
            $tag = '
    <url>
		<loc>
			' . $url . '
		</loc>
		<lastmod>
			' . $mod . '
		</lastmod>
		<priority>
			' . $p . '
		</priority>
    </url>
    ';

            $current_output .= $tag;
            return $current_output;
        }

        $output = add_url($output, 'https://lyndakade.ir/', $d_c, '1.00');
        $output = add_url($output, 'https://lyndakade.ir/contact-us', $d_c, '1.00');
        $output = add_url($output, 'https://lyndakade.ir/request-course', $d_c, '1.00');

        // $courses;
        $courses = Course::orderByDesc('created_at')->get();
        foreach ($courses as $course) {
            $course_link = 'https://lyndakade.ir/c/' . $course->id;
            $course_date = $course->updateDate ?? $course->releaseDate;
            $output = add_url($output, $course_link, $course_date, '1.00');
        }
        // $software;
        $software = Software::orderByDesc('created_at')->get();
        foreach ($software as $soft) {
            $soft_link = 'https://lyndakade.ir/' . $soft->slug . '/' . $soft->id . '-0.html';
            $output = add_url($output, $soft_link, $d_c, '0.80');
        }
        // $subjects;
        $subjects = Subject::orderByDesc('created_at')->get();
        foreach ($subjects as $sub) {
            $sub_link = 'https://lyndakade.ir/' . $sub->slug . '/' . $sub->id . '-0.html';
            $output = add_url($output, $sub_link, $d_c, '0.80');
        }

        $output .= '</urlset>';

        // save $output to sitemap.xml
        file_put_contents(public_path('sitemap.xml'), $output, LOCK_EX);
    }
}
