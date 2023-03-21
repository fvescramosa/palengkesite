<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\StallAppointment;
use App\SellerStall;
use App\Buyer;
use App\Seller;
use App\Products;
use App\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index(){


    }


    public function create(){
        $admin = Admin::all();
        return view();
    }

    public function store(Request $request){

    }

    public function show(){

    }

    public function edit($id){

    }

    public function update($id, Request $request){



    }

    public function addDeveloper(){

    }

    public function storeDeveloper(){

    }

    public function editDeveloper(){

    }

    public function updateDeveloper(){

    }
}
