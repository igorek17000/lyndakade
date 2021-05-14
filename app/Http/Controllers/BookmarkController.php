<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $user_id
     * @return Factory|View
     */
    public function index()
    {
        $bookmarks = Bookmark::all()->where('user_id', Auth::id());
        return view('bookmark.index', compact('bookmarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bookmark = new Bookmark();
        return view('bookmark.create', compact('bookmark'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Bookmark $bookmark
     * @return Factory|View
     */
    public function show($id)
    {
        $bookmark = Bookmark::find($id);
        $bookmark_parts = $bookmark->bookmark_parts;
        return view('bookmark.show', [
            'bookmark' => $bookmark,
            'bookmark_parts' => $bookmark_parts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_bookmark(Request $request)
    {
        if ($request->ajax()) {
            $course_id = $request->course_id;

            return $course_id;
        }
        return '';
    }
}
