<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/users';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }
    protected function authenticated(Request $request, $user)
    {
        //dd('ok');
        /*
        if ( $user->isAdmin() ) {// do your magic here
            return redirect()->route('dashboard');
        }*/

        return redirect(route('dashboard',Auth::id()));
    }

    public function findUsername()
    {
        $login = request()->input('email');
        //echo $login;die;

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'pin';
        //echo $fieldType;die;

        request()->merge([$fieldType => $login]);

        //dd(request());

        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Customization: Validate if client status is active (1)
        if ($this->attemptLogin($request)) {
//            dd($request->user()->userRoles()->select('role_id')->pluck('role_id'));
//            $request->user()['role'] = $request->user()->userRoles()->select('role_id')->pluck('role_id')->toArray();
            //dd($request->user());
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
