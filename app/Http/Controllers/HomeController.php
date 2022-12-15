<?php

namespace App\Http\Controllers;

use App\SellerProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(){

        $featuredProducts = SellerProduct::where('featured', 1)->limit(6)->get();


        return view('home/index', compact(['featuredProducts']));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkpoint(){


        if(auth()->user()->user_type_id == '1'){
            return redirect( route('seller.profile') );
        }
    }

    public function sample($name){
        return $name;
    }

    public function profile(){
        if(auth()->user()->user_type_id == '1'){
            return redirect( route('seller.profile') );
        }elseif(auth()->user()->user_type_id == '2'){
            return redirect( route('buyer.profile') );
        }
    }
}
