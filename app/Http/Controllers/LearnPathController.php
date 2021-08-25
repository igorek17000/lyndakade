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
        $libraries = Library::all();

        return view('learn_paths.index', [
            'libraries' => $libraries,
            'selected_library' => 'all',
        ]);
    }

    public function show_category(Request $request, $library_slug)
    {
        $libraries = Library::all();

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
            $libraries = Library::all();
            return view('learn_paths.index', [
                'libraries' => $libraries,
                'selected_library' => $learn_path_slug,
            ]);
        }

        $path = LearnPath::firstWhere('slug', $learn_path_slug);
        if ($path) {

            // $view = new \App\View(['type' => 2, 'item_id' => $path->id]);
            // $view->save();

            $js_courses = json_decode($path->courses);
            $courses = array();
            $authors = array();
            foreach ($js_courses as $c) {
                $course_id = $c->id;
                $course = Course::find($course_id);
                if ($course) {
                    array_push($courses, $course);
                    foreach ($course->authors as $author) {
                        array_push($authors, $author->id);
                    }
                }
            }
            $authors = Author::find($authors);
            $authors = array_values($authors->all());
            return view('learn_paths.show', [
                'path' => $path,
                'courses' => $courses,
                'authors' => $authors,
                'path_state' => get_learn_path_state($path), // 1 show add button, 2 show remove button, 3 has been paid
            ]);
        }
        abort(404);
        return redirect()->route('root.home');
    }
}
