<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Mail\NewUserWelcomeMail;
use App\User;
use App\Http\Controllers\Controller;
use App\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = '/landing';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        //  $this->middleware('auth:admin')->only(['showAdminRegisterForm']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


    }


    protected function register(Request $data)
    {

        $data->validate( [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string',  /*'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',*/  'confirmed'],
            'user_type_id' => '',
        ],
            [
                'password.regex' => 'Password must contain at least one number, one uppercase and one lowercase letter, and a special character.'
            ]
        );

        if($data['user_type_id'] == 1){
            session('user_type','buyer');
        }else{
            session('user_type','seller');
        }

        $create =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'inactive',
            'user_type_id' => $data['user_type_id'] ?? 1
        ]);

        if($create->save()){

            $code = uniqid();

            $verification = Verification::create([
                'user_id' => $create->id,
                'status' => 'active',
                'code' => $code,
            ]);


            $content = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'code' => $code,
            ];

            Mail::to($data['email'])->send(new NewUserWelcomeMail($content));

            return redirect(route('user.registration.success'));
        }


    }

    public function showAdminRegisterForm()
    {
        return view('auth.admin.register');
    }

    protected function createAdmin(Request $request)
    {

        $this->adminValidator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);



        if(  $admin->save() ){
            return redirect(route('admin.show.staff'))->with(['message' => 'Staff has been added', 'response' => 'success']);
        }else{
            return redirect(route('admin.show.staff'))->with(['message' => 'Failed to Add!', 'response' => 'error']);
        }

    }
    protected function adminValidator(array $data)
    {


        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string',  /*'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',*/  'confirmed'],
        ],
            [
                'password.regex' => 'Password must contain at least one number, one uppercase and one lowercase letter, and a special character.'
            ]
        );
    }
}
