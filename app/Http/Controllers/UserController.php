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

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
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

    public function dubbedCourses(Request $request)
    {
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

    public function dubbed_index(Request $request, $user_id)
    {
        $user = User::with('courses')->find($user_id);
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
