<?php

namespace App\Http\Controllers;

use App\Course;
use App\Library;
use App\Software;
use App\Subject;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubjectController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['search',]]);
    }

    //    /**
    //     * search for Subject courses
    //     *
    //     * @param Request $request
    //     * @param $slug
    //     * @return Factory|RedirectResponse|Redirector|View|string
    //     */
    //    public function search(Request $request, $slug)
    //    {
    //        $id = Subject::all()->where('slug', '=', $slug)->first()->id;
    //        $courses_id = DB::table('course_subject')->where('subject_id', '=', $id)->get('course_id');
    //        $ids = array();
    //        foreach ($courses_id as $id) {
    //            array_push($ids, $id->course_id);
    //        }
    //
    //        array_unique($ids, SORT_NUMERIC);
    //
    //        $courses = Course::all()->whereIn('id', $ids)->take(20);
    //        return view('search.search', [
    //            'courses' => $courses,
    //            'search_type' => 'subject',
    //        ]);
    //    }

    public function subjects_api()
    {
        $subjects = Subject::get();
        if (!$subjects) {
            return new JsonResponse([
                'data' => []
            ], 404);
        }
        return new JsonResponse([
            'data' => $subjects->toArray(),
        ], 200);
    }

    public function subject_add_api(Request $request)
    {
        $subject_name = $request->input('title');
        $subject_slug = $request->input('slug');
        $subject_desc = $request->input('desc');
        $lib_name = $request->input('lib');
        $sub = Subject::firstWhere('title', $subject_name);
        try {
            if (!$sub) {
                $lib = Library::firstWhere('titleEng', $lib_name);
                $sub = new Subject();
                $sub->title = $subject_name;
                $sub->slug = $subject_slug;
                $sub->description = $subject_desc;
                $sub->library()->associate($lib);
                $sub->save();
                return new JsonResponse([
                    'message' => 'success'
                ], 200);
            } else {
                $sub->update([
                    'title' => $subject_name,
                    'slug' => $subject_slug,
                    'description' => $subject_desc,
                ]);
                $lib = Library::firstWhere('titleEng', $lib_name);
                $sub->library()->associate($lib);
                return new JsonResponse([
                    'message' => 'updated'
                ], 200);
            }
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e,
            ], 400);
        }
    }
}
