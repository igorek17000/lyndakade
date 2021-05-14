<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\LearnPath;
use App\Library;
use App\Software;
use App\Subject;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * Show Admin Dashboard.
     *
     * @return Application|Factory|Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.home');
    }


    public $itemsPerPage = 10;

    function all_adds($type)
    {
        return view('admins.posts.' . $type . '-add');
    }

    public function course_add()
    {
        return $this->all_adds('course');
    }

    public function user_add()
    {
        return $this->all_adds('user');
    }

    public function library_add()
    {
        return $this->all_adds('library');
    }

    public function subject_add()
    {
        return $this->all_adds('subject');
    }

    public function software_add()
    {
        return $this->all_adds('software');
    }

    public function learnpath_add()
    {
        return $this->all_adds('learnpath');
    }

    function all_edits($item, $type)
    {
        if ($item) {
            return view('admins.posts.' . $type . '-add', [$type => $item]);
        }
        return back()->with('error', $type . ' was not found!');
    }

    public function course_edit(Request $request)
    {
        $item = Course::find($request->id);
        return $this->all_edits($item, 'course');
    }

    public function library_edit(Request $request)
    {
        $item = Library::find($request->id);
        return $this->all_edits($item, 'library');
    }

    public function subject_edit(Request $request)
    {
        $item = Subject::find($request->id);
        return $this->all_edits($item, 'subject');
    }

    public function software_edit(Request $request)
    {
        $item = Software::find($request->id);
        return $this->all_edits($item, 'software');
    }

    public function learnpath_edit(Request $request)
    {
        $item = LearnPath::find($request->id);
        return $this->all_edits($item, 'learnpath');
    }

    function all_indexes($collection, $title, $type)
    {
        return view('admins.posts.index', [
            'page' => $title,
            'pageSlug' => $type,
            'listItems' => $collection,
        ]);
    }

    public function course()
    {
        return $this->all_indexes(Course::orderBy('created_at', 'desc')->paginate($this->itemsPerPage), __('Courses'), 'course');
    }

    public function library()
    {
        return $this->all_indexes(Library::orderBy('created_at', 'desc')->paginate($this->itemsPerPage), __('Libraries'), 'library');
    }

    public function subject()
    {
        return $this->all_indexes(Subject::orderBy('created_at', 'desc')->paginate($this->itemsPerPage), __('Subjects'), 'subject');
    }

    public function software()
    {
        return $this->all_indexes(Software::orderBy('created_at', 'desc')->paginate($this->itemsPerPage), __('Software'), 'software');
    }

    public function learnpath()
    {
        return $this->all_indexes(LearnPath::orderBy('created_at', 'desc')->paginate($this->itemsPerPage), __('Learn Path'), 'learnpath');
    }

    public function user()
    {
        return $this->all_indexes(User::orderBy('created_at', 'desc')->paginate($this->itemsPerPage), __('Users'), 'user');
    }

}
