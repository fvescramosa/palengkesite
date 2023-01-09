<?php

namespace App\Http\Controllers;

use App\Buyer;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;

class BuyerController extends Controller
{
    //
    public function create(){

        if(auth()->user()->buyer()->exists()){
            return redirect(route( 'buyer.edit' , auth()->user()->id));
        }else{
            return view('buyer/create');
        }
    }

    public function store(Request $request){

        $validate = $request->validate([
            'birthday' => ['required', ''],
            'age' => ['required', 'numeric', 'min:18'],
            'gender' => ['required', ''],
            'contact' => ['required', ''],
            'stnumber' => ['required', ''],
            'stname' => ['required', ''],
            'city' => ['required', ''],
            'province' => ['required', ''],
            'country' => ['required', ''],
            'user_id' => '',
        ]);

        if($validate){
            $buyer = Buyer::create(
                [
                    'birthday' => $request->birthday,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'contact' =>  $request->contact,
                    'stnumber' =>  $request->stnumber,
                    'stname' =>  $request->stname,
                    'city' =>  $request->city,
                    'province' =>  $request->province,
                    'country' =>  $request->country,
                    'user_id' => auth()->user()->id,
                ]
            );

            if($buyer->save()){

            }

        }


        return redirect(route('buyer.profile', $buyer->user->id))->with(['message' => 'Seller info added']);
    }


    public function show(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function switch_as_seller(){

        if(Auth::user()->user_type_id == 1){


            Auth::user()->update(['user_type_id' => 2]);

            if(!Auth::user()->seller()->exists()){
                $buyer_info = Auth::user()->buyer;

                $data = [
                    'birthday' => $buyer_info->birthday,
                    'age' => $buyer_info->age,
                    'gender' => $buyer_info->gender,
                    'contact' => $buyer_info->contact,
                ];

                $seller_create = Auth::user()->seller()->create($data);
            }

        }


       return redirect(route('seller.profile'));
    }
}
