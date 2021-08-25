<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\LearnPath;
use App\Paid;
use App\UnlockedCourse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Show the profile.
     *
     * @param $username
     * @return RedirectResponse|View
     */
    public function show($username)
    {
        $user = User::firstWhere('username', $username);
        if ($user) {
            return view('admins.posts.profile-show', ['user' => $user]);
        }
        return redirect()->route('admin.home')->with('error', 'User not found');
    }

    /**
     * Update the profile
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param \App\Http\Requests\PasswordRequest $request
     * @return RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function my_courses()
    {
        $user_id = auth()->id();

        $paid_courses = Paid::where('user_id', $user_id)->where('type', 1)->get();
        $paid_learn_paths = Paid::where('user_id', $user_id)->where('type', 2)->get();

        $courses = [];
        $ids = [];
        foreach ($paid_courses as $paid_course) {
            $ids[] = $paid_course->item_id;
        }
        foreach (UnlockedCourse::where('user_id', $user_id)->whereNotNull('course_id')->get() as $unlocked_course) {
            $ids[] = $unlocked_course->course_id;
        }
        if (count($ids) > 0)
            $courses = Course::find($ids);

        $learn_paths = [];
        $ids = [];
        foreach ($paid_learn_paths as $paid_learn_path) {
            $ids[] = $paid_learn_path->item_id;
        }
        foreach (UnlockedCourse::where('user_id', $user_id)->whereNotNull('learn_path_id')->get() as $unlocked_learn_path) {
            $ids[] = $unlocked_learn_path->learn_path_id;
        }
        if (count($ids) > 0)
            $learn_paths = LearnPath::find($ids);

        return view('users.my-courses', compact(['courses', 'learn_paths']));
    }
}
