<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin.login', compact([]));
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        $maxAttempts = 4; // Maximum number of attempts allowed
        $decaySeconds = 60; // Lockout period in seconds

        // Check if the user is locked out
        $key = 'login_attempt_' . $request->email;
        $attempts = Cache::get($key, 0);
        $seconds = Cache::get($key . '_timeout', 0);

        if ($attempts >= $maxAttempts && $seconds > time()) {
            $remainingSeconds = $seconds - time();
            return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Too many login attempts. Please try again after ' . $remainingSeconds . ' seconds.']);
        }

        // Attempt to authenticate the user
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $remember);

        if ($authenticated) {
            // Reset the login attempts
            Cache::forget($key);
            Cache::forget($key . '_timeout');

            // Redirect the user to their profile
            if (Auth::user()->user_type_id == 2) {
                return redirect()->intended(route('seller.profile'))->with(['response' => 'success', 'message' => 'Login success!']);
            } else {

                return redirect()->intended(route('buyer.profile'))->with(['response' => 'success', 'message' => 'Login success!']);
            }
        } else {
            // Increment the login attempts and set the lockout timeout
            $attempts++;
            Cache::put($key, $attempts, $decaySeconds);

            // Set the lockout timeout to EXACTLY 60 seconds
            $timeout = time() + $decaySeconds;
            Cache::put($key . '_timeout', $timeout, ($timeout - time()));

            // Check if the user has reached the maximum number of attempts
            if ($attempts >= $maxAttempts) {
                $remainingSeconds = $seconds - time();
                return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Too many login attempts. Please try again after ' . $remainingSeconds . ' seconds.']);
            }

            return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Login Failed!']);
        }

    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        $maxAttempts = 4; // Maximum number of attempts allowed
        $decaySeconds = 60; // Lockout period in seconds

        // Check if the user is locked out
        $key = 'login_attempt_' . $request->email;
        $attempts = Cache::get($key, 0);
        $seconds = Cache::get($key . '_timeout', 0);

        if ($attempts >= $maxAttempts && $seconds > time()) {
            $remainingSeconds = $seconds - time();
            return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Too many login attempts. Please try again after ' . $remainingSeconds . ' seconds.']);
        }

         // Attempt to authenticate the user
         $authenticated = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember);

        if ($authenticated) {

            // Reset the login attempts
            Cache::forget($key);
            Cache::forget($key . '_timeout');

            return redirect()->intended('/admin')->with(['response' => 'success', 'message' => 'Login success!']);
        } else {
            // Increment the login attempts and set the lockout timeout
            $attempts++;
            Cache::put($key, $attempts, $decaySeconds);

            // Set the lockout timeout to EXACTLY 60 seconds
            $timeout = time() + $decaySeconds;
            Cache::put($key . '_timeout', $timeout, ($timeout - time()));

            // Check if the user has reached the maximum number of attempts
            if ($attempts >= $maxAttempts) {
                $remainingSeconds = $seconds - time();
                return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Too many login attempts. Please try again after ' . $remainingSeconds . ' seconds.']);
            }

            return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Login Failed!']);
        }
    }
}
