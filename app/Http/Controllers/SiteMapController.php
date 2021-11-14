<?php

namespace App\Http\Controllers;

use App\Author;
use App\Course;
use App\LearnPath;
use App\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    private function get_link($filename)
    {
        return "https://lyndakade.ir/" . $filename;
    }

    public function sitemap()
    {
        // $today_date = \Carbon\Carbon::now()->toDateString();

        /*$res = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!-- generated-on=\"" . \Carbon\Carbon::now()->toDateTimeString() . "\" -->
            <sitemapindex xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
            <sitemap>
                <loc>" . $this->get_link("sitemap-authors.xml") . "</loc>
                <lastmod>" . $today_date  . "</lastmod>
            </sitemap>
            <sitemap>
                <loc>" . $this->get_link("sitemap-partial.xml") . "</loc>
                <lastmod>" . $today_date  . "</lastmod>
            </sitemap>
            <sitemap>
                <loc>" . $this->get_link("sitemap-subjects.xml") . "</loc>
                <lastmod>" . $today_date  . "</lastmod>
            </sitemap>";
        */

        $courses_dates = Course::get(['releaseDate'])->map(function ($c) {
            $ee = explode('-', $c->releaseDate);
            return $ee[0] . '-' . $ee[1];
        })->toArray();
        $courses_dates = array_unique($courses_dates);
        sort($courses_dates);

        // foreach ($courses_dates as $c_d) {
        //     $filename = "sitemap-courses-" . $c_d . ".xml";
        //     $res .= "
        //     <sitemap>
        //         <loc>" . $this->get_link($filename) . "</loc>
        //         <lastmod>" . $today_date  . "</lastmod>
        //     </sitemap>";
        // }

        // $res .= "
        // </sitemapindex>";

        // $myName = "sitemap.xml";
        // $headers = [
        //     // 'Content-type' => 'text/plain',
        //     'Content-type' => 'application/xml',
        //     'Content-Disposition' => sprintf('attachment; filename="%s"', $myName),
        //     'Content-Length' => strlen($res)
        // ];
        // return response()->make($res, 200, $headers);
        return response()->view('sitemaps.index', [
            'today_date' => \Carbon\Carbon::now()->toDateString(),
            'courses_dates' => $courses_dates,
        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap_authors()
    {
        /*$today_date = \Carbon\Carbon::now()->toDateString();
        $res = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!-- generated-on=\"" . \Carbon\Carbon::now()->toDateTimeString() . "\" -->
        <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
*/
        // $authors = Author::get(['slug']);

        // foreach ($authors as $author) {
        //     $res .= "
        //     <url>
        //         <loc>
        //             " . route('authors.show', [$author->slug]) . "
        //         </loc>
        //         <lastmod>
        //             " . $today_date  . "
        //         </lastmod>
        //         <changefreq>weekly</changefreq>
        //         <priority>0.7</priority>
        //     </url>";
        // }

        // $res .= "</urlset>";

        // $myName = "sitemap-authors.xml";
        // $headers = [
        //     // 'Content-type' => 'text/plain',
        //     'Content-type' => 'application/xml',
        //     'Content-Disposition' => sprintf('attachment; filename="%s"', $myName),
        //     'Content-Length' => strlen($res)
        // ];
        // return response()->make($res, 200, $headers);
        return response()->view('sitemaps.sitemap', [
            'route_name' => 'authors.show',
            'today_date' => \Carbon\Carbon::now()->toDateString(),
            'priority' => 0.7,
            'items' => Author::get(['slug']),
        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap_subjects()
    {
        /*$today_date = \Carbon\Carbon::now()->toDateString();
        $res = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!-- generated-on=\"" . \Carbon\Carbon::now()->toDateTimeString() . "\" -->
        <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
*/
        // $subjects = Subject::get(['slug']);
        /*
        foreach ($subjects as $subject) {
            $res .= "
            <url>
                <loc>
                    " . route('home.show', [$subject->slug]) . "
                </loc>
                <lastmod>
                    " . $today_date  . "
                </lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>";
        }

        $res .= "</urlset>";
        $myName = "sitemap-subjects.xml";
        $headers = [
            // 'Content-type' => 'text/plain',
            'Content-type' => 'application/xml',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $myName),
            'Content-Length' => strlen($res)
        ];
        return response()->make($res, 200, $headers);*/

        return response()->view('sitemaps.sitemap', [
            'route_name' => 'home.show',
            'today_date' => \Carbon\Carbon::now()->toDateString(),
            'priority' => 0.7,
            'items' => Subject::get(['slug']),
        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap_learn_paths()
    {
        return response()->view('sitemaps.sitemap', [
            'route_name' => 'learn.paths.show',
            'today_date' => \Carbon\Carbon::now()->toDateString(),
            'priority' => 1,
            'items' => LearnPath::get(['slug']),
        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap_partials()
    {
        /*$today_date = \Carbon\Carbon::now()->toDateString();
        $res = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!-- generated-on=\"" . \Carbon\Carbon::now()->toDateTimeString() . "\" -->
        <urlset xmlns:video=\"http://www.google.com/schemas/sitemap-video/1.1\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
            <url>
                    <loc>
                        https://lyndakade.ir/
                    </loc>
                    <lastmod>
                        " . $today_date  . "
                    </lastmod>
                </url>
                <url>
                    <loc>
                        https://lyndakade.ir/contact-us
                    </loc>
                    <lastmod>
                        " . $today_date  . "
                    </lastmod>
                </url>
                <url>
                    <loc>
                        https://lyndakade.ir/request-course
                    </loc>
                    <lastmod>
                        " . $today_date  . "
                    </lastmod>
                </url>
                <url>
                    <loc>
                        https://lyndakade.ir/learning/courses/free
                    </loc>
                    <lastmod>
                        " . $today_date  . "
                    </lastmod>
                </url>
                <url>
                    <loc>
                        https://lyndakade.ir/learning/courses/newest
                    </loc>
                    <lastmod>
                        " . $today_date  . "
                    </lastmod>
                </url>
                <url>
                    <loc>
                        https://lyndakade.ir/learning/courses/best
                    </loc>
                    <lastmod>
                        " . $today_date  . "
                    </lastmod>
                </url>

        </urlset>";

        $myName = "sitemap-partials.xml";
        $headers = [
            // 'Content-type' => 'text/plain',
            'Content-type' => 'application/xml',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $myName),
            'Content-Length' => strlen($res)
        ];
        return response()->make($res, 200, $headers);*/

        return response()->view('sitemaps.partials', [
            'route_name' => 'home.show',
            'today_date' => \Carbon\Carbon::now()->toDateString(),
            'priority' => 1,
            'items' => [
                route('root.home'),
                route('root.contact.us'),
                route('learn.paths.index'),
                route('demands.create'),
                route('courses.newest'),
                route('courses.best'),
                route('courses.free'),
                route('faq'),
            ],
        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap_courses($year, $month)
    {
        /*
        $today_date = \Carbon\Carbon::now()->toDateString();
        $res = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!-- generated-on=\"" . \Carbon\Carbon::now()->toDateTimeString() . "\" -->
        <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"  xmlns:xhtml=\"http://www.w3.org/1999/xhtml\">";
*/
        $courses = Course::where('releaseDate', 'LIKE', "$year-$month%")->get(['slug_linkedin', 'img', 'title', 'description', 'releaseDate']);

        /*
        foreach ($courses as $course) {
            $res .= "
            <url>
                <loc>" . route('courses.show.linkedin', [$course->slug_linkedin])  . "</loc>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
                <lastmod>" . $today_date  . "</lastmod>
                <video:video>
                    <video:thumbnail_loc>
                        " . fromDLHost($course->img)  . "
                    </video:thumbnail_loc>
                    <video:title>
                        <![CDATA[ " . $course->title  . " ]]>
                    </video:title>
                    <video:description>
                        <![CDATA[ " . $course->description  . " ]]>
                    </video:description>
                    <video:publication_date>" . $course->releaseDate  . "</video:publication_date>
                </video:video>
            </url>";
        }
        $res .= "</urlset>";
        $myName = "sitemap-courses-" . $year . "-" . $month . ".xml";
        $headers = [
            // 'Content-type' => 'text/plain',
            'Content-type' => 'application/xml',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $myName),
            'Content-Length' => strlen($res)
        ];
        return response()->make($res, 200, $headers);
*/

        return response()->view('sitemaps.courses', [
            'route_name' => 'courses.show.linkedin',
            'today_date' => \Carbon\Carbon::now()->toDateString(),
            'priority' => 1,
            'items' => $courses,
        ])->header('Content-Type', 'text/xml');
    }
}
