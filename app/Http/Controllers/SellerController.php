<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Mail\NewUserWelcomeMail;
use App\Products;
use App\Buyer;
use App\Seller;
use App\SellerProduct;
use App\SellerStall;
use App\Stall;
use App\StallAppointment;
use App\Notification;
use function compact;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function response;
use function session;
use function view;

class SellerController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('complete.seller.info')->except(['create', 'store', 'haveAnyStalls']);
        $this->middleware('sellerHasStall')->only(['haveAnyStalls']);
    }

    //
    public function show(){
        $sellers = Seller::all();
        return view('seller/show', compact(['sellers']));
    }

    public function create(){

        $stalls = Stall::where('status', 'active')->get();


        if(auth()->user()->seller()->exists()){
            return redirect(route( 'seller.edit' , auth()->user()->id));
        }else{
            return view('seller/create', compact(['stalls']));
        }
    }

    public function store(Request $request){

        
        $validate = $request->validate([
            'birthday' => ['required', ''],
            'age' => ['required', 'numeric', 'min:18'],
            'gender' => ['required'],
            'market_id' => ['required'],
            'seller_type' => ['required'],
            'user_id' => '',
        ]);

        if($validate){
            $seller = Seller::create(
                [
                    'birthday' => $request->birthday,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'market_id' => $request->market_id,
                    'seller_type' => $request->seller_type,
                    'user_id' => auth()->user()->id,
                ]
            );

            if(auth()->user()->buyer()->exists() == false){
                $buyer = Buyer::create(
                    [
                        'birthday' => $request->birthday,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'market_id' => $request->market_id,
                        'seller_type' => $request->seller_type,
                        'user_id' => auth()->user()->id,
                    ]
                );

                $buyer->save();
            }

            if($seller->save()){
                $data = array('name'=>"Frank Test");

                //dd(Mail::to(auth()->user()->email)->send(new NewUserWelcomeMail()));


                echo "Basic Email Sent. Check your inbox.";
            }

        }


        return redirect(route('seller.stalls.haveany'))->with(['message' => 'Seller info added']);
    }

    public function haveAnyStalls(){

        return view('seller/haveanystalls');
    }

    public function edit(){

        $seller = Seller::findOrFail(auth()->user()->seller->id);

        return view('seller/edit', compact(['seller']));
    }

    public function update(Request $request){



        Auth::user()->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        );


        Seller::where(['id' => auth()->user()->seller->id]) -> update([
            'birthday' => $request->birthday,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        $seller = Seller::findOrFail( auth()->user()->seller->id );

        return redirect(route('seller.profile'))->with(['message' => 'Seller info Updated']);
    }

    public function profile(){

        if(auth()->user()->seller()->exists()){
            $seller = auth()->user()->seller;
            return view('seller/profile', compact(['seller']));
        }else{
            return redirect(route('seller.create'));
        }

    }






    public function switch_as_buyer(){

        if(Auth::user()->user_type_id == 2){

            if(!Auth::user()->buyer()->exists()){
                $seller_info = Auth::user()->seller;

                $data = [
                    'birthday' => $seller_info->birthday,
                    'age' => $seller_info->age,
                    'gender' => $seller_info->gender,
                ];


                Auth::user()->buyer()->create($data);

            }

        }

            session()->put('user_type', 'buyer');

        return redirect(route('buyer.profile', ['id' => Auth::user()->id]));
    }
}
