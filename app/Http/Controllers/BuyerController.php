<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    //
    public function create(){
        return view('buyer/create');
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


        return redirect(route('seller.profile'))->with(['message' => 'Seller info added']);
    }


    public function show(){

    }

    public function edit(){

    }

    public function update(){

    }
}
