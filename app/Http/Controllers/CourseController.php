<?php

namespace App\Http\Controllers;

use App\Author;
use App\Bookmark;
use App\Course;
use App\HashedData;
use App\Issue;
use App\LearnPath;
use App\Library;
use App\Paid;
use App\SkillLevel;
use App\Software;
use App\Subject;
use App\UnlockedCourse;
use App\User;
use Exception;
use Faker\Provider\Uuid;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;
use TCG\Voyager\Models\Role;
use Throwable;
use function GuzzleHttp\Psr7\str;
use function Ybazli\Faker\string;

class CourseController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show', 'load_more_new', 'load_more_popular', 'load_more_all', 'course_api', 'courses_api', 'subtitle_content']]);
    }

    /*
    private function sort_courses_by_releasedate_or_updatedate($courses)
    {
        $courses = $courses->map(function ($c) {
            return ['id' => $c->id, 'date' => $c->updateDate ?? $c->releaseDate,];
        })->sortByDesc(function ($c) {
            return verta($c['date']);
        })->take(4);
        $ids = [];
        foreach ($courses as $course) {
            $ids[] = $course['id'];
        }
        $courses = Course::with('authors')->whereIn('id', $ids)->get();

        $courses->sortByDesc(function ($model) use ($ids) {
            return array_search($model->getKey(), $ids);
        });



        return $courses;
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws Throwable
     */
    public function index()
    {
        return view('courses.index-new');

        $free_courses_count = Course::where('price', 0)->count();
        // $free_courses = $this->sort_courses_by_releasedate_or_updatedate(Course::where('price', 0)->get(['releaseDate', 'updateDate', 'id']));

        $free_courses_ids = Course::where('price', 0)
            ->get(['releaseDate', 'updateDate', 'id'])
            ->map(function ($c) {
                return ['id' => $c->id, 'date' => $c->updateDate ?? $c->releaseDate,];
            })->sortByDesc(function ($c) {
                return verta($c['date']);
            })->take(4);
        $ids = [];
        foreach ($free_courses_ids as $free_course) {
            $ids[] = $free_course['id'];
        }
        $free_courses = Course::with('authors')->whereIn('id', $ids)->get();

        $free_courses->sortByDesc(function ($model) use ($ids) {
            return array_search($model->getKey(), $ids);
        });

        $latest_courses_ids = Course::get(['releaseDate', 'updateDate', 'id'])
            ->map(function ($c) {
                return ['id' => $c->id, 'date' => $c->updateDate ?? $c->releaseDate];
            })->sortByDesc(function ($c) {
                return verta($c['date']);
            })->take(4);
        $ids = [];
        foreach ($latest_courses_ids as $latest_course) {
            $ids[] = $latest_course['id'];
        }

        $latest_courses = Course::with('authors')->whereIn('id', $ids)->get();

        $latest_courses->sortByDesc(function ($model) use ($ids) {
            return array_search($model->getKey(), $ids);
        });

        $dubbed_courses = Course::with('authors')->where('dubbed_id', 1)->limit(4)->get();

        $popular_courses = Course::with('authors')->orderBy('views', 'DESC')
            ->limit(4)->get();

        $paths = LearnPath::inRandomOrder()->limit(6)->get();

        $libs = Library::orderBy('id', 'asc')->get();
        $page_tabs = [];
        foreach ($libs as $lib) {
            $page_tabs[] = [$lib->slug, $lib->title, get_courses_for_library($lib->id)];
        }
        // $page_tabs = [
        //     [1, 'آموزش انیمیشن سه بعدی', get_courses_for_library(1)],
        //     [20, 'صوتی + موسیقی', get_courses_for_library(20)],
        //     [29, 'کسب و کار', get_courses_for_library(29)],
        //     [40, 'طراحی', get_courses_for_library(40)],
        //     [50, 'توسعه دهنده', get_courses_for_library(50)],
        //     [70, 'عکاسی', get_courses_for_library(70)],
        //     [78, 'ویدئو', get_courses_for_library(78)],
        //     [88, 'وب', get_courses_for_library(88)],
        //     [1665, 'CAD', get_courses_for_library(1665)],
        //     [1792, 'یادگیری الکترونیکی', get_courses_for_library(1792)],
        //     [2057, 'IT', get_courses_for_library(2057)],
        //     [2058, 'بازاریابی', get_courses_for_library(2058)]
        // ];

        return view('courses.index-logged-out', [
            'free_courses_count' => $free_courses_count,
            'free_courses' => $free_courses,
            'latest_courses' => $latest_courses,
            'popular_courses' => $popular_courses,
            'dubbed_courses' => $dubbed_courses,
            'paths' => $paths,
            'page_tabs' => $page_tabs,
        ]);
    }

    private function show_course(Request $request, $slug, $course)
    {
        $my_id = $course->id;

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

    public function show(Request $request, $subject, $slug, $my_id)
    {
        $course = Course::with(['authors', 'subjects', 'softwares'])->find($my_id);
        if ($course) {
            if ($course->slug == $slug) {
                return $this->show_course($request, $course->slug_linkedin, $course);
            }
        }
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
    }

    public function show_linkedin(Request $request, $slug)
    {
        $course = Course::with(['authors', 'subjects', 'softwares'])
            ->where('slug_linkedin', $slug)
            ->orWhere('slug_url', $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug . ',%')
            ->orWhere('slug_url', 'LIKE', $slug . ',%')->first();
        if ($course) {
            return $this->show_course($request, $slug, $course);
        }
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
    }

    public function not_found()
    {
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
        return abort(404);
    }

    public function mycourses()
    {
        $courses_id = [];
        $paths = [];

        foreach (Auth::user()->paids as $paid) {
            if ($paid->type == '1') {
                array_push($courses_id, $paid->item_id);
            } else {
                $learn_path = LearnPath::find($paid->item_id);
                array_push($paths, $learn_path);
            }
        }
        $courses_id = array_unique($courses_id);

        $courses = Course::find($courses_id);

        return view('courses.my-courses', [
            'courses' => $courses,
            'paths' => $paths
        ]);
    }
    private function get_sub_content($course, $lang = 'fa')
    {
        try {
            $js = json_decode($course->previewFile)[0];

            $file_path = str_replace(".mp4", ".vtt", $js->download_link);
            if ($lang != 'fa')
                $file_path = str_replace(".mp4", ".EN.vtt", $js->download_link);
            $content = Storage::disk('FTP')->get($file_path);
            // if ($lang != 'fa')
            //     dd($file_path, $content);
            if (strlen($content) > 0)
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
    public function subtitle_content(Request $request)
    {
        $course_id = $request->get('courseId');
        $lang = $request->get('lang', 'fa');
        // $video_id = $request->get('videoId');
        $course = Course::find($course_id);
        return $this->get_sub_content($course, $lang);
    }

    public function set_price_api(Request $request)
    {
        $id = $request->get('id', null);
        $price = $request->get('price', null);
        if ($id != null && $price != null) {
            $course = Course::where('id', $id);
            $course->update(['price' => $price]);
            return new JsonResponse([
                'message' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'message' => 'failed',
        ], 400);
    }

    public function course_update_view_from_linkedin_api(Request $request)
    {
        $view = intval($request->input('view'));
        $slug = $request->input('course_slug');
        $course = Course::where('slug_linkedin', $slug)
            ->orWhere('slug_url', $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug . ',%')
            ->orWhere('slug_url', 'LIKE', $slug . ',%');
        if ($course) {
            $course->update(['views' => $view]);
            return new JsonResponse([
                'message' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'message' => 'failed',
        ], 400);
    }

    public function courses_find_api(Request $request)
    {
        $slugs = explode(',', $request->input('slugs'));
        $courses_id = [];
        foreach ($slugs as $slug) {
            $course = Course::where('slug_linkedin', $slug)
                ->orWhere('slug_url', $slug)
                ->orWhere('slug_url', 'LIKE', '%,' . $slug)
                ->orWhere('slug_url', 'LIKE', '%,' . $slug . ',%')
                ->orWhere('slug_url', 'LIKE', $slug . ',%')->first();
            if ($course)
                $courses_id[] = $course->id;
        }
        if (count($slugs) == count($courses_id)) {
            return new JsonResponse([
                'courses' => $courses_id,
                'status' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'status' => 'failed',
        ], 404);
    }
    public function test_urls_api(Request $request)
    {
        if (!$request->has("slugs")) {
            return new JsonResponse([
                'message' => 'invalid parameters',
                'status' => 'failed',
            ], 404);
        }
        $slugs = explode("|", $request->get("slugs", ""));
        $messages = [];
        $messages['okays'] = [];
        foreach (Course::whereIn('slug_linkedin', $slugs)->get('slug_linkedin') as $course) {
            $messages['okays'][] = $course->slug_linkedin;
        }
        return new JsonResponse([
            'message' => $messages,
            'status' => 'success',
        ], 200);
    }

    public function test_api(Request $request)
    {
        $course_id = $request->input('course_id');
        $subjects = $request->input('subjects');
        try {
            $subjects = json_decode($subjects);
            $course = Course::find($course_id);
            if ($course && $subjects) {
                foreach ($subjects as $sub) {
                    $subject_name = $sub['name'];
                    $subject_slug = $sub['slug'];
                    $lib_name = $sub['lib'];
                    if ($subject_name && $subject_slug && $lib_name) {
                        $subject = Subject::firstWhere('title', $subject_name);
                        if ($subject) {
                            $course->subjects()->attach([$subject->id]);
                        } else {
                            $lib = Library::firstWhere('titleEng', $lib_name);
                            if ($lib) {
                                $sub = new Subject();
                                $sub->title = $subject_name;
                                $sub->slug = $subject_slug;
                                $sub->library()->associate($lib);
                                $sub->save();
                                $course->subjects()->attach([$sub->id]);
                            }
                        }
                    }
                }
                return new JsonResponse([
                    'message' => 'success',
                ], 200);
            }
        } catch (Exception $e) {
        }
        return new JsonResponse([
            'status' => 'failed',
        ], 205);
    }

    public function course_related_set_api(Request $request)
    {
        try {
            $course_id = $request->input('course_id');
            $related_courses_slug = $request->input('related_courses_slug');
            $course = Course::find($course_id);
            if ($course && $related_courses_slug) {
                Course::where('id', $course_id)->update([
                    'related_courses_slug' => $related_courses_slug
                ]);
                return new JsonResponse([
                    'message' => 'success',
                ], 200);
            }
            return new JsonResponse([
                'message' => 'failed',
            ], 400);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e,
            ], 500);
        }
    }

    public function course_subject_set_api(Request $request)
    {
        try {
            $course_id = $request->input('course_id');
            $subjects = $request->input('subjects');
            $subjects = json_decode($subjects, true);

            // $subject_name = $request->input('subject_name');
            // $subject_slug = $request->input('subject_slug');

            $lib_name = $request->input('lib_name');

            $course = Course::find($course_id);
            if ($course && $subjects) {
                DB::table('course_subject')->where('course_id', $course_id)->delete();

                foreach ($subjects['subjects'] as $subb) {
                    $subject = Subject::firstWhere('title', $subb['title']);
                    if ($subject) {
                        $course->subjects()->attach([$subject->id]);
                    } else {
                        $lib = Library::firstWhere('titleEng', $lib_name);
                        if ($lib) {
                            $sub = new Subject([
                                'title' => $subb['title'],
                                'slug' => $subb['slug'],
                                // 'library_id' => $lib->id,
                            ]);
                            // $sub->title = $subject['name'];
                            // $sub->slug = $subject['slug'];
                            $sub->library()->associate($lib);
                            $sub->save();
                            $course->subjects()->attach([$sub->id]);
                        }
                    }
                }
                return new JsonResponse([
                    'message' => 'success',
                ], 200);
            }
            return new JsonResponse([
                'message' => 'failed',
            ], 400);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e,
            ], 500);
        }
    }

    public function get_course_api($slug)
    {
        $course = Course::with(['authors', 'subjects'])->where('slug_linkedin', $slug)
            ->orWhere('slug_url', $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug . ',%')
            ->orWhere('slug_url', 'LIKE', $slug . ',%')->first();
        if (!$course) {
            return new JsonResponse([
                'data' => []
            ], 404);
        }
        return new JsonResponse([
            'data' => $course->toArray(),
            'url' => courseURL($course),
        ], 200);
    }

    public function course_api($id)
    {
        $course = Course::with(['authors', 'subjects', 'softwares'])->find($id);
        if (!$course) {
            return new JsonResponse([
                'data' => []
            ], 404);
        }
        return new JsonResponse([
            'data' => $course->toArray(),
            'url' => courseURL($course),
        ], 200);
    }

    public function courses_api()
    {
        $courses = Course::with(['authors', 'subjects', 'softwares'])->orderBy('created_at', 'desc')->limit(20)->get();
        if (!$courses) {
            return new JsonResponse([
                'data' => []
            ], 404);
        }
        return new JsonResponse([
            'data' => $courses->toArray(),
        ], 200);
    }

    private function find_slug_linkedin_from_link($link)
    {
        if (!strpos($link, 'linkedin.com')) {
            return false;
        }
        try {
            return explode("/", $link)[4];
        } catch (\Throwable $th) {
            return false;
        }
        return false;
    }

    public function course_set_thumbnail_api(Request $request)
    {
        $course_id = $request->get('course_id');
        $thumbnail = $request->get('thumbnail');
        if ($course_id && $thumbnail) {
            $course = Course::where('id', $course_id);
            $course->update(['thumbnail' => $thumbnail]);
            return new JsonResponse([
                'message' => $course->first()->titleEng . "] thumbnail is updated",
                'status' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'message' => 'parameters are not valid',
            'status' => 'error',
        ], 404);
    }

    public function course_set_img_thumbnail_api(Request $request)
    {
        $course_id = $request->get('course_id');
        $img = $request->get('img');
        $thumbnail = $request->get('thumbnail');
        if ($course_id && $thumbnail && $img) {
            $course = Course::where('id', $course_id);
            $course->update(['thumbnail' => $thumbnail, 'img' => $img]);
            return new JsonResponse([
                'message' => $course->first()->titleEng . "] thumbnail and img is updated",
                'status' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'message' => 'parameters are not valid',
            'status' => 'error',
        ], 404);
    }

    public function course_set_view_api(Request $request)
    {
        if ($request->has('courses')) {
            $courses = explode(',', $request->get('courses'));
            if (count($courses) > 0) {
                $messages = [];
                foreach ($courses as $course) {
                    $course_id = explode('|', $course)[0];
                    $view_count = explode('|', $course)[1];
                    $course = Course::where('id', $course_id);
                    if ($course) {
                        $course->update(['views' => $view_count]);
                        $messages[] = "course [" . $course->first()->titleEng . "] view is updated";
                    }
                }
                return new JsonResponse([
                    'message' => $messages,
                    'status' => 'success',
                ], 200);
            }
        }
        return new JsonResponse([
            'message' => 'parameters are not valid',
            'status' => 'error',
        ], 404);
    }
    public function course_api_get_for_aparat(Request $request)
    {
        $skipped_ids = $request->get('skipped_ids');
        if (!$skipped_ids) {
            $skipped_ids = [];
        } else {
            $skipped_ids = explode(',', $skipped_ids);
        }
        // $start_date = $request->get('start_date', '2021-04-01');
        $limit = intval($request->get('limit', 20));
        $courses = Course::with(['authors', 'subjects'])
            // ->where('created_at', '>=', $start_date)
            ->whereNotIn('id', $skipped_ids)
            ->orderBy('created_at', 'desc');
        $count = $courses->count();
        $courses = $courses->limit($limit)
            ->get(['id', 'title', 'titleEng', 'description', 'previewFile', 'previewSubtitle', 'img', 'persian_subtitle_id']);
        return new JsonResponse([
            'data' => $courses->toArray(),
            'count' => $count,
            'status' => 'success',
        ], 200);
    }
    public function course_api_get_course(Request $request)
    {
        $skipped_ids = $request->get('skipped_ids');
        if (!$skipped_ids) {
            $skipped_ids = [];
        } else {
            $skipped_ids = explode(',', $skipped_ids);
        }
        $limit = intval($request->get('limit', 20));
        $courses = Course::with(['authors', 'subjects'])
            ->whereNotIn('id', $skipped_ids)
            ->orderBy('created_at', 'asc')
            ->limit($limit)
            ->get([
                'id', 'title', 'titleEng', 'slug_linkedin', 'slug_url', 'skillLevel', 'durationHours',
                'durationMinutes', 'description', 'descriptionEng', 'releaseDate', 'updateDate',
                'partNumbers', 'previewFile', 'img', 'persian_subtitle_id', 'price'
            ]);
        return new JsonResponse([
            'data' => $courses->toArray(),
            'status' => 'success',
        ], 200);
    }

    public function course_api_check_token(Request $request)
    {
        $token = $request->get('token'); // user_id
        $token2 = $request->get('token2'); // request()->ip()
        $file = $request->get('file'); // course file
        $course = $request->get('course'); // course id
        if (!$token || !$token2 || !$file || !$course) {
            return null;
        }
        // return true;

        if (
            !HashedData::firstWhere('hashed', $token)
            || !HashedData::firstWhere('hashed', $token2)
            || !HashedData::firstWhere('hashed', $file)
            || !HashedData::firstWhere('hashed', $course)
        ) {
            return null;
        }

        // $user_ip = HashedData::firstWhere('hashed', $token2)->data;
        // if ($user_ip != request()->ip()) {
        //     return null;
        // }

        $user_id = HashedData::firstWhere('hashed', $token)->data;
        $course_id = HashedData::firstWhere('hashed', $course)->data;

        $course = Course::find($course_id);
        if ($course) {
            if ($course->price == 0) {
                return true;
            }
        } else {
            return null;
        }

        $user = User::find($user_id);
        if ($user) {
            if ($user->role->id == Role::firstWhere('name', 'admin')->id) {
                return true;
            }
        } else {
            return null;
        }

        if (Paid::where('user_id', $user_id)->where('item_id', $course_id)->get()->first()) {
            return true;
        }

        $paid_learn_paths = Paid::where('user_id', $user_id)->where('type', 2)->get();
        foreach ($paid_learn_paths as $paid_learn_path) {
            // foreach (js_to_courses(LearnPath::find($paid_learn_path->item_id)->_courses) as $course) {
            foreach (js_to_courses(LearnPath::find($paid_learn_path->item_id)->courses) as $course) {
                if ($course->id == $course_id)
                    return true;
            }
        }


        if (UnlockedCourse::where('user_id', $user_id)->where('course_id', $course_id)->first()) {
            return true;
        }

        $user_unlocked_courses = UnlockedCourse::where('user_id', $user_id)->whereNotNull('learn_path_id')->get();
        foreach ($user_unlocked_courses as $user_unlocked_course) {
            // foreach (js_to_courses(LearnPath::find($user_unlocked_course->learn_path_id)->_courses) as $course) {
            foreach (js_to_courses(LearnPath::find($user_unlocked_course->learn_path_id)->courses) as $course) {
                if ($course->id == $course_id)
                    return true;
            }
        }

        return null;
    }

    public function course_api_get_hashed_data(Request $request)
    {
        $hashed = $request->get('hashed');

        $hashed_data = HashedData::firstWhere('hashed', $hashed);
        if ($hashed_data) {
            return $hashed_data->data;
        }
        return null;
    }

    public function courses_with_link_api(Request $request)
    {
        $link = $request->get('link');
        if (!$link) {
            return new JsonResponse([
                'data' => [],
                'status' => 'link is required',
            ], 200);
        }
        $slug = $this->find_slug_linkedin_from_link($link);
        if (!$slug) {
            return new JsonResponse([
                'data' => [],
                'status' => 'link is not valid',
            ], 200);
        }
        $course = Course::where('slug_linkedin', $slug)
            ->orWhere('slug_url', $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug)
            ->orWhere('slug_url', 'LIKE', '%,' . $slug . ',%')
            ->orWhere('slug_url', 'LIKE', $slug . ',%')->first();
        if (!$course) {
            return new JsonResponse([
                'data' => [],
                'status' => 'course was not found',
            ], 200);
        }
        return new JsonResponse([
            'data' => $course->toArray(),
            'url' => courseURL($course),
            'status' => 'success',
        ], 200);
    }

    public function download_course(Request $request, $id)
    {

        $course = Course::find($id);

        function fix_path_link($file_path)
        {
            $file_path = str_replace('%20', ' ', $file_path);
            $file_path = str_replace('%28', '(', $file_path);
            $file_path = str_replace('%29', ')', $file_path);
            $file_path = str_replace('%2C', ',', $file_path);
            if ($file_path[strlen($file_path) - 1] == ' ') {
                $file_path = substr($file_path, 0, strlen($file_path) - 1);
            }
            return $file_path;
        }

        function get_file_from_ftp($course, $file_type)
        {
            $file_path = json_decode($course->{$file_type})[0]->download_link;
            $file_path = fix_path_link($file_path);
            $file_name = json_decode($course->{$file_type})[0]->original_name;
            $file_path_clone = explode('/', '/' . $file_path);
            $file_path_clone = array_splice($file_path_clone, 0, count($file_path_clone) - 1);
            $file_path_clone = join('/', $file_path_clone);
            if ($file_type == 'previewFile') {
                $file_name = 'previewFile.mp4';
            }
            if ($file_type == 'previewSubtitle') {
                $file_name = 'previewSubtitle.srt';
            }

            create_hashed_data_if_not_exists($file_path);

            return redirect(fromDLHost($file_path) . '?' . hash('sha512', Uuid::uuid()));
        }


        $previewFile = $request->input(hash('md5', 'previewFile'));
        if ($previewFile && hash('sha256', auth()->id()) == $previewFile) {
            return get_file_from_ftp($course, 'previewFile');
        }
        $previewSubtitle = $request->input(hash('md5', 'previewSubtitle'));
        if ($previewSubtitle && hash('sha256', auth()->id()) == $previewSubtitle) {
            return get_file_from_ftp($course, 'previewSubtitle');
        }
        $courseFile = $request->input(hash('md5', 'courseFile'));
        if ($courseFile && hash('sha256', auth()->id()) == $courseFile) {
            return get_file_from_ftp($course, 'courseFile');
        }
        $persianSubtitleFile = $request->input(hash('md5', 'persianSubtitleFile'));
        if ($persianSubtitleFile && hash('sha256', auth()->id()) == $persianSubtitleFile) {
            return get_file_from_ftp($course, 'persianSubtitleFile');
        }
        $exFiles = $request->input(hash('md5', 'exFiles'));
        if ($exFiles && hash('sha256', auth()->id()) == $exFiles) {
            $filename = $request->get('filename');
            $filename = fix_path_link($filename);
            foreach (json_decode($course->exerciseFile) as $file) {
                if ($filename == fix_path_link($file->original_name)) {
                    $file_path = $file->download_link;
                    $file_path = fix_path_link($file_path);

                    return redirect(fromDLHost($file_path) . '?' . hash('sha512', Uuid::uuid()));
                    // return Storage::disk('FTP')->download('/public_html/' . $file->download_link, $file->original_name, [
                    //     'Content-Disposition' => 'inline'
                    // ]);
                }
            }
        }
        return new JsonResponse([], 404);
    }

    public function newest(Request $request)
    {
        $courses = \App\Course::with(['authors', 'subjects', 'softwares'])->orderBy('created_at', 'DESC')->get();

        if ($request->ajax()) {
            $page = $request->get('page', null);
            if (!$page) {
                return [];
            }
            $res = [];
            foreach ($courses->forPage(intval($page), 40) as $course) {
                $res[] = $this->get_course_tile($course->id);
            }
            return $res;
        }
        return view('courses.date', ['courses' => $courses->forPage(1, 40), 'coursetype' => 'newest']);
    }

    public function best(Request $request)
    {
        $courses = \App\Course::with(['authors', 'subjects', 'softwares'])->orderBy('views', 'desc')->get();

        if ($request->ajax()) {
            $page = $request->get('page', null);
            if (!$page) {
                return [];
            }
            $res = [];
            foreach ($courses->forPage(intval($page), 40) as $course) {
                $res[] = $this->get_course_tile($course->id);
            }
            return $res;
        }
        return view('courses.date', ['courses' => $courses->forPage(1, 40), 'coursetype' => 'best']);
    }

    public function free(Request $request)
    {
        $courses = \App\Course::with(['authors', 'subjects', 'softwares'])->where('price', 0)->get();
        if ($request->ajax()) {
            $page = $request->get('page', null);
            if (!$page) {
                return [];
            }
            $res = [];
            foreach ($courses->forPage(intval($page), 40) as $course) {
                $res[] = $this->get_course_tile($course->id);
            }
            return $res;
        }
        return view('courses.date', ['courses' => $courses->forPage(1, 40), 'coursetype' => 'free']);
    }

    public function get_course_tile($id)
    {
        if (Course::find($id))
            return view('courses.partials._course_list_grid', ['course' => Course::find($id)])->render();
        return 'not found';
    }

    public function add_view(Request $request, $id)
    {
        $course = Course::where('id', $id)->get()->first();
        if ($course) {
            $course->increment('views');

            return new JsonResponse([
                'status' => 'success',
                'message' => 'view is added successfully to ' . $course->titleEng,
            ], 200);
        }
        return new JsonResponse([
            'status' => 'failed',
            'message' => 'course was not found',
        ], 200);
    }

    public function add_views(Request $request, $id, $count)
    {
        $course = Course::where('id', $id)->get()->first();
        if ($course) {
            $count = intval($count);
            while ($count > 0) {
                $course->increment('views');
                $count--;
            }

            return new JsonResponse([
                'status' => 'success',
                'message' => 'view is added successfully to ' . $course->titleEng,
            ], 200);
        }
        return new JsonResponse([
            'status' => 'failed',
            'message' => 'course was not found',
        ], 200);
    }

    public function courses_set_slug_linkedin(Request $request)
    {
        $course_id = $request->input('course_id');
        if (!$course_id) {
            return new JsonResponse([
                'message' => 'course id is required',
                'status' => 'error',
            ], 500);
        }

        $slug_linkedin = $request->input('slug_linkedin');
        if (!$slug_linkedin) {
            return new JsonResponse([
                'message' => 'slug linkedin is required',
                'status' => 'error',
            ], 500);
        }

        $course = Course::where('id', $course_id);

        // return new JsonResponse([
        //     'course' => $course,
        //     'slug_linkedin' => $slug_linkedin,
        // ], 200);

        if ($course) {
            $course->update(['slug_linkedin' => $slug_linkedin]);
            return new JsonResponse([
                'message' => 'course has been updated',
                'status' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'message' => 'course was not found',
            'status' => 'error',
        ], 404);
    }

    public function courses_all_api(Request $request)
    {
        $with = $request->has('with') ? explode(',', $request->get('with')) : null;
        if ($with) {
            $courses =  Course::with($with)->orderBy('created_at', 'desc');
        } else {
            $courses =  Course::orderBy('created_at', 'desc');
        }

        if ($request->has('cols')) {
            $cols = explode(',', $request->get('cols'));
            $courses = $courses->get($cols);
        } else {
            $courses = $courses->get();
        }

        $page = intval($request->get('page', 1));
        $perPage = $request->has('perPage') ? intval($request->get('perPage')) : null;

        $res = [
            'data' => null,
            'count' => null,
        ];

        if ($perPage) {
            if ($perPage < 1) {
                $perPage = 1;
            }
            $n = count($courses) / $perPage;
            if ($n - (int)$n > 0) {
                $n = (int)$n + 1;
            }
            if ($page > $n) {
                $page = $n;
            }
            $courses = $courses->forPage($page, $perPage);

            $res['page'] = $page;
            $res['perPage'] = $perPage;
            $res['total_pages'] = $n;
        }

        $res['data'] = $courses->toArray();
        $res['count'] = count($courses);

        return new JsonResponse($res, 200);
    }

    public function courses_api_set(Request $request)
    {
        $course = Course::where('id', $request->input('id'));
        if ($course->get()->first()) {
            $course->update(['courseFile' => $request->get('courseFile')]);
            $course->update(['exerciseFile' => $request->get('exerciseFile')]);
            return new JsonResponse([
                'message' => 'course has been updated',
                'status' => 'success',
            ], 200);
        }
        return new JsonResponse([
            'message' => 'course was not found',
            'status' => 'error',
        ], 404);
    }

    public function report_issues(Request $request)
    {
        $course_id  = $request->get('id');
        $course = Course::firstWhere('id', $course_id);
        if ($course) {
            $report_text  = $request->get('report_text');
            $report_type  = $request->get('report_type');

            $issue = new Issue();
            $issue->type = $report_type;
            $issue->text = $report_text;
            $issue->course()->associate($course);
            // $issue->course_id = $course_id;

            if ($issue->save()) {
                return back()->with('message', 'گزارش با موفقیت ارسال شد.');
            }
        }
        return back()->with('message', 'در ارسال گزارش، مشکلی رخ داده است، لطفا دوباره تلاش کنید.');
    }
}
