<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Util\SMSHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    protected $redirectPath = '/';
    protected $loginPath    = 'login';
    protected $username     = 'username';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request) {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            if (!$user->isStudent()) {
                session($request->session()->put('user', $user));
                Auth::logout();

                return redirect()->to("twoFactorAuthentication");
            }

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Gets the page for two factor authentication.
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    protected function getTwoFactorAuthentication() {
        $user = session("user");
        if ($user == null) {
            return redirect()->to("login");
        }

        // Send the verification code
        $code = SMSHelper::sendVerificationCode($user);
        session(['verificationCode' => $code]);

        return view("auth.twoFactor")->with(['user' => $user]);
    }

    /**
     * Processed the two factor authentication attempt.
     * @param Request $request
     * @return Redirect
     */
    protected function postTwoFactorAuthentication(Request $request) {
        $user             = session("user");
        $verificationCode = session("verificationCode");

        if (strcmp($verificationCode, $request->verificationCode) == 0) {
            Auth::login($user);
            $throttles = $this->isUsingThrottlesLoginsTrait();

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        return back()->withErrors(['verificationCode' => "Verification Code is incorrect."]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
