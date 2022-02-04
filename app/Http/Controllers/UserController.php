<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
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
        $courses = [];
        return view('users.dubbed-courses', [
            'courses' => $courses
        ]);
    }
}
