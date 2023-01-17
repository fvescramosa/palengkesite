<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index(){

        return view('admin.index');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function create(){
        $admin = Admin::all();
        return view();
    }

    public function store(Request $request){

    }

    public function show(){
        $staffs = new Admin();

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['name', 'asc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['name', 'desc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);

            
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['name', 'asc'];
            $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
        }

        $staffs=$staffs->get();

        return view('admin.users/staff', compact(['staffs']));
    }

    public function setMarket(Request $request){
        session(['market' => $request->marketOption]);

      
        return redirect( url()->previous() );
    }
}
