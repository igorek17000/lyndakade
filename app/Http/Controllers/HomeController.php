<?php

namespace App\Http\Controllers;

use App\Author;
use App\Course;
use App\LearnPath;
use App\Library;
use App\Mail\ContactUsMailer;
use App\SkillLevel;
use App\Software;
use App\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

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
            $courses = Course::find($ids);

            $details = $this->prepare_for_search_page($request, $courses);
            $filtered_items = $details['filtered_items'];
            $courses = $details['courses']->sortByDesc('releaseDate');
            $categories_filter = $details['categories_filter'];

            return view('search.search', [
                'shown_item' => $sub,
                'filtered_items' => $filtered_items,
                'courses' => $courses->take(20),
                'categories_filter' => $categories_filter,
            ]);
        }
        // abort(404);
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
    }

    function show_first_object($obj, $type, $request)
    {
        $query = $request->get('q');

        $details = $this->prepare_for_search_page($request, $obj->courses);

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
                $res['courses_count'] = $courses->count();
                $res['page'] = $page;
                if (!$page) {
                    return $res;
                }
                if (!($courses->count() / 20 <= intval($page))) {
                    return $res;
                }
                foreach ($courses->forPage(intval($page), 20) as $course) {
                    $res['courses'][] = $this->get_course_timeline($course->id);
                }
                $res['hasMore'] = $courses->count() / 20 >= intval($page) + 1;
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
            // return [];

            // $subjects = Subject::with('courses')->search($query)->distinct('subjects.id')->get();
            // $result = array_merge($result, $subjects->toArray());
            // if (count($result) > $count) {
            //     return $result;
            // }
            // $software = Software::with('courses')->search($query)->distinct('software.id')->get();
            // $result = array_merge($result, $software->toArray());
            // return $result;
        }

        return view('search.search', [
            'q' => $request->get('q'),
            'object' => [
                'type' => $type,
                'img' => $obj->img ?? null,
                'title' => $obj->name ?? ($obj->titleper ?? $obj->title),
                'description' => $obj->description,
            ],
            'filtered_items' => $filtered_items,
            'result_count' => count($courses),
            'courses' => count($courses) > 20 ? $courses->take(20) : $courses,
            'categories_filter' => $categories_filter,
        ]);
    }

    public function get_course_timeline($course_id)
    {
        $course = Course::find($course_id);
        if ($course)
            return view('courses.partials._course_list_timeline', ['course' => $course])->render();
        return 'not found';
    }

    public function search_page(Request $request)
    {
        $query = $request->get('q');
        if (!$query) {
            return redirect('/');
        }

        $author = Author::with('courses')->firstWhere('name', $query);
        if ($author) {
            return $this->show_first_object($author, 'مدرس', $request);
        }

        $software = Software::with('courses')->where('title', $query)->first();
        if ($software) {
            return $this->show_first_object($software, 'نرم افزار', $request);
        }

        $subject = Subject::with('courses')->where('title', $query)->first();
        if ($subject) {
            return $this->show_first_object($subject, 'دسته', $request);
        }


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
                $res['courses_count'] = $courses->count();
                $res['page'] = $page;
                if (!$page) {
                    return $res;
                }
                if (!($courses->count() / 20 <= intval($page))) {
                    return $res;
                }
                foreach ($courses->forPage(intval($page), 20) as $course) {
                    $res['courses'][] = $this->get_course_timeline($course->id);
                }
                $res['hasMore'] = $courses->count() / 20 >= intval($page)+1;
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
                if ($subject->title) {
                    $a['title'] = $subject->title;
                } else {
                    $a['title'] = $subject->name;
                }
                $a['count'] = count($subject->courses->whereIn('id', $courses_id));
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
                    'count' => count($courses->where('skillLevel', $skill->id)),
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
        array_push(
            $categories_filter,
            prepare_categories_filter_item($request, 'نرم افزار ها', 'software', $softwares_id, $courses_id)
        );
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
}
