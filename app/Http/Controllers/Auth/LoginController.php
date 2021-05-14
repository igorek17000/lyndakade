<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Middleware\RedirectIfAuthenticated;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        // session(['redirectToAfterLogin' => url()->previous()]);
    }

    // /**
    //  * The user has been authenticated.
    //  *
    //  * @param Request $request
    //  * @param mixed $user
    //  * @return mixed
    //  */
    // protected function authenticated(Request $request, $user)
    // {
    //     dd(session('redirectToAfterLogin', '/'));
    //     return redirect(session('redirectToAfterLogin', '/'));
    // }

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->intended(route('root.home'));
        }

        return $next($request);
    }

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password']), $request->get('remember', false))) {
            if (auth()->user()->isAdmin() && !session('redirectToAfterLogin', false)) {
                return redirect()->route('voyager.dashboard');
            }
            if (strpos(session('redirectToAfterLogin', '/'), 'admin')) {
                if (auth()->user()->isAdmin())
                    return redirect()->route('voyager.dashboard');
                return redirect('/');
            }
            return redirect(session('redirectToAfterLogin', '/'));
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        return redirect()->route('login')
            ->with(['error', 'نام کاربری و پسورد اشتباه است.']);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'username' => $user->email,
                    'password' => Hash::make('123456'),
                ]);
                Auth::login($newUser);
                return redirect()
                    ->intended(route('root.home'));
            }
        } catch (Exception $e) {
            return redirect()->route('login');
        }
    }
}
