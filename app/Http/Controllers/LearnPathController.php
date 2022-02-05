<?php

namespace App\Http\Controllers;

use App\Author;
use App\Course;
use App\Http\Requests\LearnPathRequest;
use App\LearnPath;
use App\Library;
use App\Software;
use App\Subject;
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

        $path = LearnPath::firstWhere('slug', $learn_path_slug);
        if ($path) {

            // $view = new \App\View(['type' => 2, 'item_id' => $path->id]);
            // $view->save();
            $authors = array();

            

            // foreach ($path->_courses as $key => $course) {
            foreach ($path->courses as $key => $course) {
                foreach ($course->authors as $author) {
                    array_push($authors, $author->id);
                }
            }
            $authors = Author::find($authors);
            $authors = array_values($authors->all());
            return view('learn_paths.show', [
                'path' => $path,
                // 'courses' => $path->_courses,
                'courses' => $path->courses,
                'authors' => $authors,
                'path_state' => get_learn_path_state($path),
            ]);
        }
        return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
        abort(404);
        return redirect()->route('root.home');
    }


    public function course_list_api(Request $request, $slug)
    {
        $path = LearnPath::firstWhere('slug', $slug);

        $res = [];
        // foreach ($path->_courses as $c) {
        foreach ($path->courses as $c) {
            if ($c) {
                $res[] = $c->slug_linkedin;
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
                // 'courses' => js_to_courses($path->_courses),
                'courses' => js_to_courses($path->courses),
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
