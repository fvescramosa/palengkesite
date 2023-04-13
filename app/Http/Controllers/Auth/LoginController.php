<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
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

        //dd($request);

//        dd(Auth::guard('web')->attempt(['email' => $request->email_address,'password' => $request->password,'status' => 'active']));
        $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->get('remember'));


        /*if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }*/

//        dd($attempt);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->get('remember'))) {

            if(Auth::user()->user_type_id == 2){
//                $this->clearLoginAttempts($request);
                return redirect()->intended(route('seller.profile'))->with(['response' => 'success', 'message' => 'Login success!']);
            }else{
//                $this->clearLoginAttempts($request);
                return redirect()->intended(route('buyer.profile'))->with(['response' => 'success', 'message' => 'Login success!']);
            }
        }
        $this->incrementLoginAttempts($request);
        return back()->withInput($request->only('email', 'remember'))->with(['response' => 'error', 'message' => 'Login Failed!']);

    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {


            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
