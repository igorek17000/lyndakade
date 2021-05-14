<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Software;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftwareController extends Controller
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
            $software = Software::where('id', $request->id)->first();
            if ($software->delete()) {
                return back()->with('success', 'The software has been deleted!');
            }
            return back()->with('error', 'somthing went wrong.');
        }
        return back()->with('error', 'You are not admin.');
    }

    public function get_all(Request $request)
    {
        $result = array();
        if ($request->ajax()) {
            foreach (Software::all() as $software) {
                $item = array();
                $item['value'] = $software->id;
                $item['text'] = $software->title;
                array_push($result, $item);
            }
        }
        return $result;
    }

}
