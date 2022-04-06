<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use App\Course;
use App\Http\Requests\LearnPathRequest;
use App\LearnPath;
use App\Library;
use App\Software;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LearnPathController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show', 'show_category']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function index(Request $request)
    {
        $libraries = Library::with(['paths'])->get();

        return view('learn_paths.index', [
            'libraries' => $libraries,
            'selected_library' => 'all',
        ]);
    }

    public function show_category(Request $request, $library_slug)
    {
        $libraries = Library::with(['paths'])->get();

        return view('learn_paths.index', [
            'libraries' => $libraries,
            'selected_library' => $library_slug,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $library_slug
     * @param $learn_path_slug
     * @return Factory|RedirectResponse|Response|View
     */
    public function show($learn_path_slug)
    {
        $lib = Library::firstWhere('slug', $learn_path_slug);
        if ($lib) {
            $libraries = Library::with(['paths'])->get();
            return view('learn_paths.index', [
                'libraries' => $libraries,
                'selected_library' => $learn_path_slug,
            ]);
        }

        $path = LearnPath::where('slug', $learn_path_slug)
            ->orWhere('slug', 'LIKE', '%,' .  $learn_path_slug)
            ->orWhere('slug', 'LIKE', '%,' .  $learn_path_slug . ',%')
            ->orWhere('slug', 'LIKE',  $learn_path_slug . ',%')
            ->first();
        if ($path) {

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
            // // $view = new \App\View(['type' => 2, 'item_id' => $path->id]);
            // // $view->save();
            // $authors = array();

            // $courses = $path->_courses->with('authors')->get();

            // // foreach ($path->_courses as $key => $course) {
            // foreach ($courses as $key => $course) {
            //     foreach ($course->authors as $author) {
            //         array_push($authors, $author->id);
            //     }
            // }
            // $authors = Author::find($authors);
            // $authors = array_values($authors->all());
            return view('learn_paths.show', [
                'path' => $path,
                'courses' => $path->_courses,
                // 'courses' => $path->courses,
                'authors' => $path->authors(),
                'path_state' => get_learn_path_state($path),
            ]);
        }
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
        abort(404);
        return redirect()->route('root.home');
    }

    public function set_category_api(Request $request)
    {
        $data = $request->get('data');
        if ($data) {
            $data = explode('|', $data);
            foreach ($data as $d) {
                $d = json_decode($d);
                $cat_titleEng = $d->cat_titleEng;
                $cat_title = $d->cat_title;
                $cat = Category::where('titleEng', $cat_titleEng)->first();
                if (!$cat) {
                    Category::create([
                        'title' => $cat_title,
                        'titleEng' => $cat_titleEng,
                    ]);
                    $cat = Category::where('titleEng', $cat_titleEng)->first();
                }

                $path = LearnPath::where('slug', $d->path_slug)
                    ->orWhere('slug', 'LIKE', '%,' .  $d->path_slug)
                    ->orWhere('slug', 'LIKE', '%,' .  $d->path_slug . ',%')
                    ->orWhere('slug', 'LIKE',  $d->path_slug . ',%')
                    ->first();

                $path->category()->associate($cat);
                unset($path->_courses);
                $path->save();
            }
        }
    }

    public function set_courses_id_api(Request $request)
    {
        // $p = LearnPath::where('id', 29)->first();
        // $courses = Course::whereIn('id', explode(',', $p->courses_id))
        //     ->orderByRaw("FIELD(id, $p->courses_id)")->get('id');
        // return new JsonResponse([
        //     'courses' => $courses,
        //     'ids' => $p->courses_id,
        //     'status' => 'success',
        // ], 200);
        $paths = LearnPath::get();
        foreach ($paths as $path) {
            $ids = [];
            foreach (json_decode($path->courses) as $course) {
                $ids[] = $course->id;
            }
            $ids = implode(',', $ids);
            LearnPath::where('id', $path->id)->update([
                'courses_id' => $ids
            ]);
        }
    }

    public function course_list_api(Request $request, $slug)
    {
        $path = LearnPath::where('slug', $slug)
            ->orWhere('slug', 'LIKE', '%,' .  $slug)
            ->orWhere('slug', 'LIKE', '%,' .  $slug . ',%')
            ->orWhere('slug', 'LIKE',  $slug . ',%')
            ->first();

        $res = [];
        foreach ($path->_courses as $c) {
            // foreach ($path->courses as $c) {
            if ($c) {
                $res[] = $c;
            }
        }
        return new JsonResponse([
            'data' => $res,
            'status' => 'success',
        ], 200);
    }

    public function get_api(Request $request)
    {
        $path = LearnPath::where('id', $request->get('id'));

        if ($request->has('cols')) {
            $cols = explode(',', $request->get('cols'));
            $path = $path->get($cols)->first();
        } else {
            $path = $path->first();
        }
        if (!$path) {
            return new JsonResponse([
                'data' => $path,
                'status' => 'failed',
            ], 404);
        }

        return new JsonResponse([
            'data' => [
                'id' => $request->get('id'),
                'courses' => js_to_courses($path->_courses),
                // 'courses' => js_to_courses($path->courses),
            ],
            'status' => 'success',
        ], 200);
    }

    public function get_all_api(Request $request)
    {
        if ($request->has('cols')) {
            $cols = explode(',', $request->get('cols'));
            $paths = LearnPath::get($cols);
        } else {
            $paths = LearnPath::get();
        }

        return new JsonResponse([
            'data' => $paths,
            'status' => 'success',
        ], 200);
    }

    public function set_img_api(Request $request)
    {
        $id = $request->get('id');
        $img = $request->get('img');
        $thumbnail = $request->get('thumbnail');

        if (!$id) {
            return new JsonResponse([
                'message' => 'need id',
                'status' => 'failed',
            ], 404);
        }
        if (!$img) {
            return new JsonResponse([
                'message' => 'need img',
                'status' => 'failed',
            ], 404);
        }
        // if (!$thumbnail) {
        //     return new JsonResponse([
        //         'message' => 'need thumbnail',
        //         'status' => 'failed',
        //     ], 404);
        // }
        $path = LearnPath::find($id);
        if (!$path) {
            return new JsonResponse([
                'message' => 'id is not valid',
                'status' => 'failed',
            ], 404);
        }
        $path = LearnPath::where('id', $id)->update([
            'img' => $img,
            'thumbnail' => $thumbnail
        ]);

        return new JsonResponse([
            'message' => 'updated ' . LearnPath::find($id)->titleEng,
            'status' => 'success',
        ], 200);
    }
}
