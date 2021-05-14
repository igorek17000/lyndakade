<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {

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
            $subject = Subject::where('id', $request->id)->first();
            if ($subject->delete()) {
                return back()->with('success', 'The subject has been deleted!');
            }
            return back()->with('error', 'somthing went wrong.');
        }
        return back()->with('error', 'You are not admin.');
    }

    public function get_all(Request $request)
    {
        $result = array();
        if ($request->ajax()) {
            foreach (Subject::all() as $subject) {
                $item = array();
                $item['value'] = $subject->id;
                $item['text'] = $subject->title;
                array_push($result, $item);
            }
        }
        return $result;
    }

}
