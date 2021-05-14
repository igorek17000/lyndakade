<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param Request $request
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
            $library = Library::where('id', $request->id)->first();
            if ($library->delete()) {
                return back()->with('success', 'The library has been deleted!');
            }
            return back()->with('error', 'somthing went wrong.');
        }
        return back()->with('error', 'You are not admin.');
    }

    public function get_all(Request $request)
    {
        $result = array();
        if ($request->ajax()) {
            foreach (Library::all() as $library) {
                $item = array();
                $item['value'] = $library->id;
                $item['text'] = $library->title;
                array_push($result, $item);
            }
        }
        return $result;
    }

}
