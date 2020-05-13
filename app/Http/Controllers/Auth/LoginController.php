<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function fixIntendedUrl() {
        \Log::info("Current intended url:". \Session::get('url.intended'));
        $intended = \Session::get('url.intended');
        $base = parse_url($intended,PHP_URL_SCHEME)."://".parse_url($intended,PHP_URL_HOST);
        \Log::info("Base: $base");
        $newBase = url('');
        \Log::info("Replace with $newBase");
        $intended = str_replace($base,$newBase,$intended);
        \Log::info("New Intended: $intended");
        \Session::put('url.intended',$intended);
    }
    public function login(Request $request)
    {
        $this->fixIntendedUrl();
//        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        \Log::info("Calling cas->user");
        /*$auth = cas()->checkAuthentication();
        if (!$auth) cas()->authenticate();*/
        $username = cas()->user();
        \Log::info("User: $username is being logged in");
        try {
            $user = User::whereUsername($username)->firstOrFail();
            \Log::info("Logging in $user->username");
            \Auth::login($user);
            \Log::info("sending login response");
            logUserLogin($user,"web");
            return $this->sendLoginResponse($request);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            $this->incrementLoginAttempts($request);
            cas()->logoutWithUrl(env('CAS_REDIRECT_PATH'));
            return $this->sendFailedLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        \Log::info("Session regenerated");
        $this->clearLoginAttempts($request);

        \Log::info("Login attempts cleared. redirecting..");
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
    public function username()
    {
        return 'username';
    }
    public function showLoginForm(Request $request)
    {
        return $this->login($request);
    }
    public function casCallback(Request $request) {
        \Log::info("Cas is logged on. Going to login");
        $this->login($request); //Jump to authentication
    }
    public function logout(Request $request)
    {
        $this->middleware(['cas.auth']);
        $this->guard()->logout();
        $request->session()->invalidate();
        cas()->logoutWithUrl(env('CAS_LOGOUT_REDIRECT'));
        return $this->loggedOut($request) ?: redirect('/');
    }
}
