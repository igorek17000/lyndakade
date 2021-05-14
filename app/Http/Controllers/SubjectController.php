<?php

namespace App\Http\Controllers;

use App\Course;
use App\Software;
use App\Subject;
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
}
