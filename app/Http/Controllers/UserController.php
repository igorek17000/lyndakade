<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Paid;
use App\UnlockedCourse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display a listing of the users
     *
     * @param User $model
     * @return View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    /**
     * Display logged in user's profile
     *
     * @return View
     */
    public function my_profile()
    {
        return view('users.my-profile', ['user' => Auth::user()]);
    }

    /**
     * Display edit profile page for logged in user
     *
     * @return View
     */
    public function edit()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    /* public function update_profile(Request $request)
    {
        if (auth()->check()) {
            $id = auth()->id();
            $user = auth()->user();
            $errors = false;
            if (User::where('username', $request->input('username'))->count() > 0 && $user->username != $request->input('username')) {
                $errors = true;
            }
            if (User::where('email', $request->input('email'))->count() > 0 && $user->email != $request->input('email')) {
                $errors = true;
            }
            if (!$errors) {
                User::where('id', $id)->update([
                    'name' => $request->input('name', $user->name),
                    'firstName' => $request->input('firstName', $user->firstName),
                    'lastName' => $request->input('lastName', $user->lastName),
                    'username' => $request->input('username', $user->username),
                    'email' => $request->input('email', $user->email),
                    'mobile' => $request->input('mobile', $user->mobile),
                    'avatar' => $request->input('avatar', $user->avatar),
                ]);
            }
        }
    }
*/
    /**
     * Display apply changes requested by logged in user
     *
     * @param Request $request
     * @return View
     */
    public function update(Request $request)
    {
        $slug = 'users';

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $id = Auth::id();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = $model->findOrFail($id);
        }

        // Check permission
        // $this->authorize('edit', $data);

        // $request_data = array_merge($request->all(), );
        // dd($request_data);
        $request->request->add(['role_id' => auth()->user()->role_id]);

        // if ($request->request['password'] != $request->request['password_confirm']) {
        //     return redirect()->route('my-profile.edit')->with('error', 'کلمه های عبور یکسان نیستند.');
        // }
        // unset($request->request['password_confirm']);
        // $request->request['password'] = Hash::make($request->request['password']);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->route('my-profile');
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    public function username_check(Request $request)
    {
        $username = $request->get('username');
        $user = User::firstWhere('username', $username);
        $res = [
            'result' => false,
            'msg' => 'نام کاربری در دسترس میباشد.',
        ];

        if ($user || strpos(Str::lower($username), 'admin')) {
            $res['result'] = true;
            $res['msg'] = 'نام کاربری در دسترس نمیباشد.';
        }
        return $res;
    }

    public function dubbedUsersInDashboard(Request $request)
    {
        $users = User::with(['invoices'])->where('role_id', 3)->get(['id', 'username', 'invoices.*']);

        $users = $users->map(function ($user) {
            $data = prepare_dubbed_panel_data_for_user($user);
            return [
                'id' => $user->id,
                'username' => $user->username,
                'invoices' => $data['invoices'],
                'factors' => $data['factors'],
                'total_received' => $data['total_received'],
                'total_balance' => $data['total_balance'],
                'total_income' => $data['total_income'],
            ];
        });
    }

    public function dubbedCourses(Request $request)
    {
        $data = prepare_dubbed_panel_data_for_user(auth()->user());

        return view('users.dubbed-courses-new', [
            'invoices' => $data['invoices'],
            'factors' => $data['factors'],
            'total_received' => $data['total_received'],
            'total_balance' => $data['total_balance'],
            'total_income' => $data['total_income'],
        ]);

        $courses = auth()->user()->courses;

        $user_percent = auth()->user()->dubbed_percent / 100;
        $res_courses = [];

        $total_balance = 0;

        foreach ($courses as $course) {
            $course_total_purchase = Paid::where(['item_id' => $course->id, 'type' => 1])->count();
            $course_total_unlocked = UnlockedCourse::where(['course_id' => $course->id])->count();

            // جمع کل خرید این دوره
            $balance_purchase = Paid::where(['item_id' => $course->id, 'type' => 1])->sum('price') * $user_percent;
            // جمع کل خرید این دوره از طریق اشتراک
            $balance_unlocked = $course_total_unlocked * $course->price * $user_percent;

            $total_balance += $balance_purchase + $balance_unlocked;

            $res_courses[] = [
                'link' => courseURL($course),
                'title' => $course->title,
                'price' => $course->price,
                'course_total_purchase' => $course_total_purchase,
                'balance_purchase' => $balance_purchase,
                'course_total_unlocked' => $course_total_unlocked,
                'balance_unlocked' => $balance_unlocked,
            ];
        }

        $total_received = 0;

        foreach (auth()->user()->invoices as $invoice) {
            $total_received += $invoice->price;
        }

        $total_balance -= $total_received;

        return view('users.dubbed-courses', [
            'user' => auth()->user(),
            'courses' => json_decode(json_encode($res_courses), FALSE),
            'invoices' => auth()->user()->invoices,
            'total_received' => $total_received,
            'total_balance' => $total_balance,
        ]);
    }

    public function dubbed_index(Request $request, $username)
    {
        $user = User::with('courses')->firstWhere(['username' => $username]);
        if (!$user || $user->role_id != 3) {
            return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
        }

        $courses = $user->courses;
        if ($request->ajax()) {
            $res = [
                'courses' => [],
                'hasMore' => false,
            ];
            if (count($courses) > 0) {
                $page = $request->get('page', null);
                if (!$page) {
                    return $res;
                }
                if (intval($courses->count() / 20) + 1 < intval($page)) {
                    return $res;
                }
                foreach ($courses->forPage(intval($page), 20) as $course) {
                    $res['courses'][] = $this->get_course_timeline($course);
                }
                $res['hasMore'] = intval($courses->count() / 20) + 1 >= intval($page) + 1;
                return $res;
            }
        }
        return view('authors.show', [
            'user' => $user,
            'courses' => $courses->take(20),
            'total_courses' => count($courses),
            'hasMore' => count($courses) > 20
        ]);
    }
}
