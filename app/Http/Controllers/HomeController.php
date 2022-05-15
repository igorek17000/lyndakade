<?php

namespace App\Http\Controllers;

use App\Author;
use App\Course;
use App\LearnPath;
use App\Library;
use App\Mail\ContactUsMailer;
use App\Package;
use App\SkillLevel;
use App\Software;
use App\Subject;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admins.dashboard');
    }


    /**
     * Show the application contact_us.
     *
     * @return Renderable
     */
    public function set_lang(Request $request, $lang)
    {
        if (strtolower($lang) == "fa") {
            App::setLocal('fa');
        } else {
            App::setLocal('en');
        }
        return redirect()->back();
    }

    /**
     * Show the application contact_us.
     *
     * @return Renderable
     */
    public function contact_us()
    {
        return view('contactUs');
    }

    /**
     * store contact us form data
     *
     * @return Renderable
     */
    public function contact_us_post(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $type = $request->get('type');
        $message = $request->get('message');

        Mail::to('contactus@lyndakade.ir')->send(new ContactUsMailer($name, $email, $message, $type));

        return response()->json([
            'message'    => 'اطلاعات با موفقیت ارسال شد',
            'alert-type' => 'info',
        ]);
        // return view('contactUs')->with(['message' => 'اطلاعات با موفقیت ارسال شد', 'alert-type' => 'info']);
    }

    /**
     * @param $slug
     * @param $id
     * @return Application|Factory|View|string
     */
    public function show(Request $request, $slug)
    {
        $sub = Library::with('subjects.courses')->where('slug', $slug)->orWhere('slug', str_replace("-training-tutorials", "", $slug))->get()->first();
        if (!$sub)
            $sub = Subject::with('courses')->where('slug', $slug)->orWhere('slug', str_replace("-training-tutorials", "", $slug))->get()->first();
        // if (!$sub)
        //     $sub = Software::with('courses')->where('slug', $slug)->get()->first();

        if ($sub) {
            $ids = [];
            if ($sub->subjects) {
                $subjects = $sub->subjects;
                foreach ($subjects as $subject) {
                    foreach ($subject->courses as $course) {
                        $ids[] = $course->id;
                    }
                }
            } else {
                foreach ($sub->courses as $course) {
                    $ids[] = $course->id;
                }
            }
            $ids = array_unique($ids);
            $courses = Course::whereIn('id', $ids);
            $total_courses = $courses->count();
            // $courses =  $courses->limit(20)->get();
            // $details = $this->prepare_for_search_page($request, $courses);
            // $filtered_items = $details['filtered_items'];
            // $courses = $details['courses']->sortByDesc('releaseDate');
            // $categories_filter = $details['categories_filter'];

            return view('subjects.show', [
                'subject' => $sub,
                'total_courses' => $total_courses,
            ]);
        }
        // abort(404);
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
    }

    public function get_course_timeline($course)
    {
        return view('courses.partials._course_list_new', ['course' => $course])->render();
    }

    public function search_page(Request $request)
    {
        $query = $request->get('q');
        if (!$query) {
            return redirect('/');
        }
        $author = Author::with('courses')->firstWhere('name', $query);
        if ($author) {
            return redirect()->route('authors.show', [$author->slug]);
        }
        $subject = Subject::with('courses')->where('title', $query)->orWhere('title_per', $query)->first();
        if ($subject) {
            return redirect()->route('home.show', [$subject->slug]);
        }

        return view('search.search', [
            'q' => $request->get('q'),
            'total_courses' => Course::search($query)->distinct('courses.id')->count(),
        ]);

        $searched = Course::with(['subjects', 'authors'])->search($query)->distinct('courses.id')->get();

        // $courses_id = [];
        // foreach ($searched as $course) {
        //     array_push($courses_id, $course->id);
        // }
        // $searched = Course::find(array_unique($courses_id));

        $details = $this->prepare_for_search_page($request, $searched);
        $filtered_items = $details['filtered_items'];
        $courses = $details['courses'];
        $categories_filter = $details['categories_filter'];

        if ($request->ajax()) {
            $res = [
                'courses' => [],
                'hasMore' => false,
            ];
            if (count($courses) > 0) {
                $page = $request->get('page', null);
                if (!$page) {
                    return $res;
                }
                if (intval($courses->count() / 20) + 1 < intval($page)) {
                    return $res;
                }

                $res['courses'] = view('courses.partials._course_list_new_total', [
                    'courses' => $courses->forPage(intval($page), 20),
                ])->render();
                // foreach ($courses->forPage(intval($page), 20) as $course) {
                //     $res['courses'][] = $this->get_course_timeline($course);
                // }
                $res['hasMore'] = intval($courses->count() / 20) + 1 >= intval($page) + 1;
                return $res;
            }

            // $learn_paths = LearnPath::with('library')->search($query)->distinct('learn_paths.id')->get();
            // $searched = $learn_paths->toArray();
            // if (count($searched) > 0) {
            //     return $searched;
            // }

            // $authors = Author::with('courses')->search($query)->distinct('authors.id')->get();
            // $searched = $authors->toArray();

            // if (count($searched) > 0) {
            //     return $searched;
            // }
            return [];

            // // $subjects = Subject::with('courses')->search($query)->distinct('subjects.id')->get();
            // // $result = array_merge($result, $subjects->toArray());
            // // if (count($result) > $count) {
            // //     return $result;
            // // }
            // // $software = Software::with('courses')->search($query)->distinct('software.id')->get();
            // // $result = array_merge($result, $software->toArray());
            // // return $result;
        }

        return view('search.search', [
            'q' => $request->get('q'),
            'filtered_items' => $filtered_items,
            'result_count' => count($courses),
            'courses' => count($courses) > 20 ? $courses->take(20) : $courses,
            'categories_filter' => $categories_filter,
            'hasMore' => count($courses) > 20
        ]);
    }


    private function prepare_for_search_page(Request $request, $courses)
    {
        function prepare_categories_filter_item(Request $request, $title, $search_key, $collection, $courses_id)
        {
            $item = [];
            $item['title'] = $title;
            $item['items'] = [];
            $item['key'] = $search_key;

            foreach ($collection as $subject) {
                $a = [];
                $query = $_GET;
                $query[$search_key] = $subject->id;
                $query_result = $request->url() . '?' . http_build_query($query);
                $a['link'] = $query_result;
                if ($subject->title_per) {
                    $a['title'] = $subject->title_per;
                } else if ($subject->title) {
                    $a['title'] = $subject->title;
                } else {
                    $a['title'] = $subject->name;
                }
                $a['count'] = $subject->courses->whereIn('id', $courses_id)->count();
                array_push($item['items'], $a);
            }
            $item['hasMore'] = count($collection) > 5;

            usort($item['items'], function ($a, $b) {
                if ($a['count'] == $b['count']) {
                    return 0;
                }
                return ($a['count'] > $b['count']) ? -1 : 1;
            });
            return $item;
        }


        $categories_filter = [];

        // creating links for skillLevels
        $query = $_GET;
        $skill_items = [];
        foreach (SkillLevel::all() as $skill) {
            $query['skill'] = $skill->id;
            array_push(
                $skill_items,
                [
                    'title' => $skill->title,
                    'titleEng' => $skill->titleEng,
                    'link' => $request->url() . '?' . http_build_query($query),
                    'count' => $courses->where('skillLevel', $skill->id)->count(),
                ]
            );
        }

        $subjects_id = [];
        $softwares_id = [];
        $authors_id = [];
        $courses_id = [];
        foreach ($courses as $course) {
            array_push($courses_id, $course->id);
            foreach ($course->subjects as $item)
                array_push($subjects_id, $item->id);
            foreach ($course->softwares as $item)
                array_push($softwares_id, $item->id);
            foreach ($course->authors as $item)
                array_push($authors_id, $item->id);
        }

        $subjects_id = Subject::find(array_unique($subjects_id));
        $softwares_id = Software::find(array_unique($softwares_id));
        $authors_id = Author::find(array_unique($authors_id));

        array_push(
            $categories_filter,
            [
                'title' => 'سطح',
                'items' => $skill_items,
                'hasMore' => false,
                'key' => 'skill',
            ]
        );
        array_push(
            $categories_filter,
            prepare_categories_filter_item($request, 'دسته ها', 'subject', $subjects_id, $courses_id)
        );
        // array_push(
        //     $categories_filter,
        //     prepare_categories_filter_item($request, 'نرم افزار ها', 'software', $softwares_id, $courses_id)
        // );
        array_push(
            $categories_filter,
            prepare_categories_filter_item($request, 'مدرسان', 'author', $authors_id, $courses_id)
        );

        $filtered_items = [];
        foreach ($_GET as $key => $value) {
            if ($key == 'software') {
                $item = Software::where('id', $value)->get()->first();
                if ($item) {
                    $query = $_GET;
                    unset($query[$key]);
                    $link = $request->url() . '?' . http_build_query($query);
                    array_push($filtered_items, [
                        'key' => $key,
                        'title' => $item->title,
                        'link' => $link,
                    ]);
                    $courses_id = [];
                    foreach ($item->courses as $course) {
                        array_push($courses_id, $course->id);
                    }
                    $courses = $courses->whereIn('id', array_unique($courses_id));
                }
            }
            if ($key == 'subject') {
                $item = Subject::where('id', $value)->get()->first();
                if ($item) {
                    $query = $_GET;
                    unset($query[$key]);
                    $link = $request->url() . '?' . http_build_query($query);
                    array_push($filtered_items, [
                        'key' => $key,
                        'title' => $item->title,
                        'link' => $link,
                    ]);
                    $courses_id = [];
                    foreach ($item->courses as $course) {
                        array_push($courses_id, $course->id);
                    }
                    $courses = $courses->whereIn('id', array_unique($courses_id));
                }
            }
            if ($key == 'author') {
                $item = Author::where('id', $value)->get()->first();
                if ($item) {
                    $query = $_GET;
                    unset($query[$key]);
                    $link = $request->url() . '?' . http_build_query($query);
                    array_push($filtered_items, [
                        'key' => $key,
                        'title' => $item->name,
                        'link' => $link,
                    ]);
                    $courses_id = [];
                    foreach ($item->courses as $course) {
                        array_push($courses_id, $course->id);
                    }
                    $courses = $courses->whereIn('id', array_unique($courses_id));
                }
            }
            if ($key == 'skill') {
                $item = SkillLevel::where('id', $value)->get()->first();
                if ($item) {
                    $query = $_GET;
                    unset($query[$key]);
                    $link = $request->url() . '?' . http_build_query($query);
                    array_push($filtered_items, [
                        'key' => $key,
                        'title' => $item->title,
                        'link' => $link,
                    ]);
                    $courses_id = [];
                    foreach ($item->courses() as $course) {
                        array_push($courses_id, $course->id);
                    }
                    $courses = $courses->whereIn('id', array_unique($courses_id));
                }
            }
        }

        return [
            'filtered_items' => $filtered_items,
            'courses' => $courses,
            'categories_filter' => $categories_filter,
        ];
    }

    public function json_data_authors()
    {
        return response()->json(Author::query()->get(['name']));
    }

    public function json_data_courses()
    {
        return response()->json(Course::query()->get(['title']));
    }

    public function json_data_learn_paths()
    {
        return response()->json(LearnPath::query()->get(['title']));
    }

    public function json_data_libraries()
    {
        return response()->json(Library::query()->get(['title']));
    }

    public function json_data_software()
    {
        return response()->json(Software::query()->get(['title']));
    }

    public function json_data_subjects()
    {
        return response()->json(Subject::query()->get(['title']));
    }

    public function test2_url(Request $request)
    {
        return view('users.my-profile-new');
    }

    public function test_url(Request $request)
    {
        $course = Course::with(['authors', 'subjects', 'softwares'])->find(2161);
        $slug = $course->slug_linkedin;

        $view_dt = Carbon::now();
        $view_date = $view_dt->format('Y-m-d');
        $view = \App\View::firstWhere('date', $view_date);
        if ($view) {
            $view->increment('views');
        } else {
            $view = new \App\View();
            $view->date = $view_date;
            $view->views = 1;
            $view->save();
        }
        $related_courses = [];
        if ($course->related_courses_slug) {
            $related_slugs = explode(',', $course->related_courses_slug);
            $related_courses = Course::with('authors')->whereIn('slug_linkedin', $related_slugs);
            foreach ($related_slugs as $r_slug) {
                $related_courses = $related_courses
                    ->orWhere('slug_url',  $r_slug)
                    ->orWhere('slug_url', 'LIKE', '%,' .  $r_slug)
                    ->orWhere('slug_url', 'LIKE', '%,' .  $r_slug . ',%')
                    ->orWhere('slug_url', 'LIKE',  $r_slug . ',%');
            }
            $related_courses = $related_courses->get();
        }

        if (count($related_courses) == 0) {
            $subjectIds = $course->subjects->pluck('id')->toArray();
            $related_courses = Course::with('authors')->whereHas('subjects', function ($query) use ($subjectIds) {
                return $query->whereIn('subjects.id', $subjectIds);
            })->where('id', '!=', $course->id)
                ->limit(52)
                ->get();
        }

        $related_paths = LearnPath::where('courses_id', $course->id)
            ->orWhere('courses_id', 'LIKE', $course->id . ',%')
            ->orWhere('courses_id', 'LIKE', '%,' . $course->id . ',%')
            ->orWhere('courses_id', 'LIKE', '%,' . $course->id)
            ->get();

        $skillEng = SkillLevel::find($course->skillLevel)->titleEng;
        $skill = SkillLevel::find($course->skillLevel)->title;

        $has_subtitle = true;
        try {
            foreach (json_decode($course->previewSubtitle) as $subtitle) {
            }
            if (json_decode($course->previewSubtitle) == 0) {
                $has_subtitle = false;
            }
        } catch (Exception $e) {
            $has_subtitle = false;
        }
        $previewSubtitleContent = $this->get_sub_content($course, 'fa');
        $previewSubtitleContentEng = $this->get_sub_content($course, 'en');

        $dubbed_course = Course::where('slug_linkedin', $slug . '-dubbed')
            ->orWhere('slug_url',  $slug . '-dubbed')
            ->orWhere('slug_url', 'LIKE', '%,' .  $slug . '-dubbed')
            ->orWhere('slug_url', 'LIKE', '%,' .  $slug . '-dubbed' . ',%')
            ->orWhere('slug_url', 'LIKE',  $slug . '-dubbed' . ',%')->first();

        $has_dubbed = false;
        if ($dubbed_course) {
            $has_dubbed = $dubbed_course->id;
        }

        $subjects = $course->subjects()->withCount('courses')->orderBy('courses_count', 'desc')->get();

        dd($previewSubtitleContent, $previewSubtitleContentEng);

        return view('courses.show', [
            'skill' => $skill,
            'skillEng' => $skillEng,
            'course' => $course,
            'previewSubtitleContent' => $previewSubtitleContent,
            'previewSubtitleContentEng' => $previewSubtitleContentEng,
            'has_dubbed' => $has_dubbed,
            'has_subtitle' => $has_subtitle,
            'related_courses' => $related_courses,
            'related_paths' => $related_paths,
            'subjects' => $subjects,
            'course_state' => get_course_state($course), // 1 = purchased,  2 = added to cart, 3 = not added to cart
        ]);
    }

    private function get_sub_content($course, $lang = 'fa')
    {
        try {
            $file_path = str_replace(".mp4", ".vtt", $course->previewFile);
            if ($lang != 'fa')
                $file_path = str_replace(".mp4", ".en.vtt", $course->previewFile);
            dd($file_path);
            $content = Storage::disk('FTP')->get($file_path);
            if (strpos(strtolower("WEBVTT"), strtolower($content)) != false)
                return $content;
            return '';
        } catch (Exception $e) {
        }
        return '';
        $subtitle = json_decode($course->previewSubtitle);
        try {
            foreach ($subtitle as $file) {
                $content = Storage::disk('FTP')->get($file->download_link);
                if (strpos(strtolower("WEBVTT"), strtolower($content)))
                    return $content;
            }
        } catch (Exception $e) {
        }
        return '';
    }
}
