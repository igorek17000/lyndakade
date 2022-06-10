<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector|View
     */
    public function index()
    {
        if (Auth::check()
            || true
        ) {
//        $users = User::where('id', '!=', Auth::id())->get();
            $users = DB::select("select users.id,
                                         users.name,
                                         users.firstName,
                                         users.lastName,
                                         users.email,
                                         users.avatar,
                                         count(is_read) as unread
                                            from users
                                            Left JOIN messages ON
                                                users.id = messages.from
                                                and
                                                is_read = 0
                                                and
                                                messages.to = " . Auth::id() . "
                                                where users.id != " . Auth::id() . "
                                                group by users.id, users.name, users.avatar, users.firstName, users.lastName, users.email");
            return view('admin.index', [
                'users' => $users,
            ]);
        }
        return redirect()->route('login');
    }
}
