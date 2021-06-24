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
    public $items_per_page = 10;

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

        $paths = LearnPath::limit(6)->get();

        $page_tabs = [['3D-Animation', 1, 'آموزش انیمیشن سه بعدی', 'active'], ['Audio-Music', 1665, 'صوتی + موسیقی', ''], ['Business', 29, 'کسب و کار', ''], ['Design', 40, 'طراحی', ''], ['Developer', 50, 'توسعه دهنده', ''], ['Photography', 70, 'عکاسی', ''], ['Video', 78, 'ویدئو', ''], ['Web', 88, 'وب', ''], ['CAD', 1665, 'CAD', ''], ['Education-Elearning', 1792, 'یادگیری الکترونیکی', ''], ['IT', 2057, 'IT', ''], ['Marketing', 2058, 'بازاریابی', '']];

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

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $subject
     * @param $slug
     * @param $my_id
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Request $request, $subject, $slug, $my_id)
    {
        $course = Course::with(['authors', 'subjects', 'softwares'])->find($my_id);
        if ($course) {
            if ($course->slug == $slug) {
                $course->increment('views');
                // views($course)->record();

                $view = new \App\View([
                    'course_id' => $course->id,
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'ip' => $request->ip(),
                ]);
                $view->save();

                // $date  = Carbon::now()->subMonths(2);
                // \App\View::where('created_at', '<=', $date)->delete();

                /*
                 * getting courses id related to subjects
                 */
                $subjects = $course->subjects;
                $subjects_id = array();
                foreach ($subjects as $subject) {
                    array_push($subjects_id, $subject->id);
                }
                $courses_id = DB::table('course_subject')
                    ->whereIn('subject_id', $subjects_id)
                    ->get('course_id');

                $ids = array();
                foreach ($courses_id as $id) {
                    array_push($ids, $id->course_id);
                }

                /*
                 * getting courses id related to software
                 */
                $softwares = $course->softwares;
                $softwares_id = array();
                foreach ($softwares as $software) {
                    array_push($softwares_id, $software->course_id);
                }
                $courses_id = DB::table('course_software')
                    ->whereIn('software_id', $softwares_id)
                    ->get('course_id');

                foreach ($courses_id as $id) {
                    array_push($ids, $id->course_id);
                }

                while (($key = array_search($my_id, $ids)) !== false) {
                    unset($ids[$key]);
                }
                $ids = array_values(array_unique($ids));

                $related_courses = Course::with('authors')->orderBy('views', 'DESC')->whereIn('id', $ids)->limit(50)->get();

                $courses = array();
                foreach ($related_courses as $related_course) {
                    array_push($courses, $related_course);
                }

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

                return view('courses.show', [
                    'skill' => $skill,
                    'skillEng' => $skillEng,
                    'course' => $course,
                    'has_subtitle' => $has_subtitle,
                    'related_courses' => $courses,
                    'course_state' => get_course_state($course), // 1 = purchased,  2 = added to cart, 3 = not added to cart
                ]);
            }
        }
        abort(404);
        return redirect()->route('root.home');
    }

    public function show_linkedin(Request $request, $slug_linkedin)
    {
        $course = Course::with(['authors', 'subjects', 'softwares'])->firstWhere('slug_linkedin', $slug_linkedin);
        if ($course) {
            $course->increment('views');
            $my_id = $course->id;

            $view = new \App\View([
                'course_id' => $course->id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'ip' => $request->ip(),
            ]);
            $view->save();

            // $date  = Carbon::now()->subMonths(2);
            // \App\View::where('created_at', '<=', $date)->delete();

            /*
                 * getting courses id related to subjects
                 */
            $subjects = $course->subjects;
            $subjects_id = array();
            foreach ($subjects as $subject) {
                array_push($subjects_id, $subject->id);
            }
            $courses_id = DB::table('course_subject')
                ->whereIn('subject_id', $subjects_id)
                ->get('course_id');

            $ids = array();
            foreach ($courses_id as $id) {
                array_push($ids, $id->course_id);
            }

            /*
                 * getting courses id related to software
                 */
            $softwares = $course->softwares;
            $softwares_id = array();
            foreach ($softwares as $software) {
                array_push($softwares_id, $software->course_id);
            }
            $courses_id = DB::table('course_software')
                ->whereIn('software_id', $softwares_id)
                ->get('course_id');

            foreach ($courses_id as $id) {
                array_push($ids, $id->course_id);
            }

            while (($key = array_search($my_id, $ids)) !== false) {
                unset($ids[$key]);
            }
            $ids = array_values(array_unique($ids));

            $related_courses = Course::with('authors')->orderBy('views', 'DESC')->whereIn('id', $ids)->limit(50)->get();

            $courses = array();
            foreach ($related_courses as $related_course) {
                array_push($courses, $related_course);
            }

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

            return view('courses.show', [
                'skill' => $skill,
                'skillEng' => $skillEng,
                'course' => $course,
                'has_subtitle' => $has_subtitle,
                'related_courses' => $courses,
                'course_state' => get_course_state($course), // 1 = purchased,  2 = added to cart, 3 = not added to cart
            ]);
        }
        abort(404);
        return redirect()->route('root.home');
    }

    public function not_found()
    {
        return abort(404);
    }

    public function mycourses()
    {
        $courses_id = [];

        foreach (Auth::user()->paids as $paid) {
            if ($paid->type == '1') {
                array_push($courses_id, $paid->item_id);
            } else {
                $learn_path = LearnPath::find($paid->item_id);
                foreach ($learn_path->courses as $course) {
                    array_push($courses_id, $course->id);
                }
            }
        }
        $courses_id = array_unique($courses_id);

        $courses = Course::find($courses_id);

        return view('courses.my-courses', [
            'courses' => $courses,
        ]);
    }

    public function subtitle_content(Request $request)
    {
        $course_id = $request->get('courseId');
        $video_id = $request->get('videoId');
        $course = Course::find($course_id);
        $subtitle = json_decode($course->previewSubtitle);

        foreach ($subtitle as $file) {
            $content = Storage::disk('FTP')->get($file->download_link);
            return '<pre>' . $content . '</pre>';
        }
        return '';
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
    public function course_api_get_for_aparat(Request $request)
    {
        $skipped_ids = $request->get('skipped_ids');
        if (!$skipped_ids) {
            $skipped_ids = [];
        } else {
            $skipped_ids = explode(',', $skipped_ids);
        }
        $start_date = $request->get('start_date', '2021-04-01');
        $limit = intval($request->get('limit', 20));
        $courses = Course::with(['authors', 'subjects', 'softwares'])
            ->where('releaseDate', '>=', $start_date)
            ->whereNotIn('id', $skipped_ids)
            ->orderBy('created_at', 'asc')
            ->limit($limit)
            ->get(['id', 'title', 'titleEng', 'description', 'previewFile', 'previewSubtitle', 'img', 'persian_subtitle_id']);
        return new JsonResponse([
            'data' => $courses->toArray(),
            'status' => 'success',
        ], 200);
    }

    public function course_api_check_token(Request $request)
    {
        $token = $request->get('token'); // user_id
        $file = $request->get('file'); // course file
        $course = $request->get('course'); // course id
        if (!$token || !$file || !$course) {
            return null;
        }
        return true;

        // if (!HashedData::firstWhere('hashed', $token)
        //     || !HashedData::firstWhere('hashed', $file)
        //     || !HashedData::firstWhere('hashed', $course)
        // ) {
        //     return null;
        // }

        // $token = HashedData::firstWhere('hashed', $token)->data;
        // $file = HashedData::firstWhere('hashed', $file)->data;
        // $course = HashedData::firstWhere('hashed', $course)->data;

        // $user = User::find($token);
        // if ($user) {
        //     if ($user->role->id == Role::firstWhere('name', 'admin')->id) {
        //         return true;
        //     }
        // }

        // $paid = Paid::where('user_id', $token)->where('item_id', $course);
    }

    public function course_api_get_hashed_data(Request $request)
    {
        $hashed = $request->get('hashed');

        // $hashed_data = HashedData::firstWhere('hashed', $hashed);
        // if ($hashed_data) {
        //     return $hashed_data->data;
        // }
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
        $slug_linkedin = $this->find_slug_linkedin_from_link($link);
        if (!$slug_linkedin) {
            return new JsonResponse([
                'data' => [],
                'status' => 'link is not valid',
            ], 200);
        }
        $course = Course::firstWhere('slug_linkedin', $slug_linkedin);
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

            return redirect(fromDLHost($file_path) . '?' . hash('sha512', Uuid::uuid()));

            // $ftp = Storage::createFtpDriver([
            //     'host'     => 'dl.lyndakade.ir',
            //     'username' => 'pz11914',
            //     'password' => 'ashkan1996',
            //     'port'     => '21',
            //     'timeout'  => 9999999,
            //     'root' => 'public_html',
            //     'disable_asserts' => true,
            // ]);
            // return $ftp->download('./' . $file_path);

            // return $ftp->response($file_path, $file_name, [], 'attachment');


            // return Storage::disk('FTP')->download('/' . $file_path, $file_name, [
            //     'Accept-Ranges' => 'bytes',
            //     // 'Content-Disposition' => 'inline',
            //     // 'Content-Type' => 'application/octet-stream',
            // ]);


            // return response()->stream(function () use ($file_path) {
            //     echo file_get_contents(fromDLHost($file_path));
            // }, 200, ['Accept-Ranges' => 'bytes']);


            // return response()->download(fromDLHost($file_path), $file_name, [
            //     'Accept-Ranges' => 'bytes',
            //     'Content-Disposition' => 'inline',
            //     'Content-Type' => 'application/octet-stream',
            // ]);


            // $fs = Storage::disk('FTP');
            // // dd($fs->allFiles($file_path_clone));
            // $stream = $fs->readStream('/' . $file_path);
            // $mime = explode('.', $file_name);
            // $mime = $mime[count($mime) - 1];
            // return response()->stream(
            //     function () use ($stream) {
            //         fpassthru($stream);
            //     },
            //     200,
            //     [
            //         'Accept-Ranges' => 'bytes',
            //         'Content-Type' => $mime,
            //         'Content-disposition' => 'attachment; filename="' . $file_name . '"',
            //     ]
            // );
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
        $courses =  Course::with(['authors', 'subjects', 'softwares'])->orderBy('created_at', 'desc')->get();

        $page = intval($request->get('page', 1));
        $perPage = intval($request->get('perPage', 15));
        if ($perPage > 200)
            $perPage = 200;
        $n = count($courses) / $perPage;
        if ($n - (int)$n > 0)
            $n = (int)$n + 1;
        if ($page > $n)
            $page = $n;
        $courses = $courses->forPage($page, $perPage);
        return new JsonResponse([
            'data' => $courses->toArray(),
            'page' => $page,
            'perPage' => $perPage,
            'total_pages' => $n,
        ], 200);
    }

    public function courses_api_set(Request $request, $id)
    {
        $course = Course::where('id', $id);
        if ($course->get()->first()) {
            $course->update(['thumbnail' => $request->get('thumbnail')]);
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
