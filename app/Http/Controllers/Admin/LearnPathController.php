<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\LearnPathRequest;
use App\LearnPath;
use App\Library;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LearnPathController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param LearnPathRequest $request
     * @return array|RedirectResponse
     */
    public function store(LearnPathRequest $request)
    {
        $response = array();
        $learn_path = LearnPath::where('title', $request->title)->first();
        if ($learn_path) {
            $response['status'] = 'A Learn Path with this title already exist.';
        } else {
            $learn_path = new LearnPath();

            $learn_path->title = $request->title;
            $learn_path->description = $request->description;
            $learn_path->titleEng = $request->titleEnglish;
            $learn_path->descriptionEng = $request->descriptionEnglish;
            $learn_path->price = $request->price;
            $learn_path->priceOffPercent = $request->priceOffPercent;

            $learn_path_path = 'learn paths/' . $learn_path->slug;
            $request->logo->storeAs($learn_path_path . '/logo', $request->logo->getClientOriginalName());
            $learn_path->img = $learn_path_path . '/logo/' . $request->logo->getClientOriginalName();

            $library = Library::find(explode(',', $request->libraries)[0]);
            $courses = Course::find(explode(',', $request->courses));

//        dd($request->libraries, explode(',', $request->libraries));

            if ($learn_path->save()) {
                $total_hours = 0;
                $total_minutes = 0;
                foreach ($courses as $course) {
                    $total_hours += $course->durationHours;
                    $total_minutes += $course->durationMinutes;
                }

                while ($total_minutes >= 60) {
                    $total_minutes -= 60;
                    $total_hours += 1;
                }

                $learn_path->durationMinutes = $total_minutes;
                $learn_path->durationHours = $total_hours;

                $learn_path->courses()->attach($courses);
                $learn_path->library()->associate($library);
                $learn_path->save();

                $response['status'] = 'Learn Path Added successfully.';
            } else {
                $response['status'] = 'Something went wrong, try again.';
            }
        }
        return back()->with('success', $response['status']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $path = LearnPath::where('id', $request->id)->first();
            if ($path->delete()) {
                return back()->with('success', 'The learn path has been deleted!');
            }
            return back()->with('error', 'somthing went wrong.');
        }
        return back()->with('error', 'You are not admin.');
    }
}
