<?php

namespace App\Http\Controllers;

use App\Categories;
use App\SellerProduct;
use function auth;
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

        $categories = Categories::all();


        return view('home/index', compact(['featuredProducts', 'categories']));
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
            return redirect( route('buyer.profile',  ['id' => auth()->user()->id]) );
        }elseif(auth()->user()->user_type_id == '2'){
            return redirect( route('seller.create') );
        }
    }
}
