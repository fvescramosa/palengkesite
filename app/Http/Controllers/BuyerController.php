<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\User;
use App\DeliveryAddress;
use function dd;
use function extract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function json_decode;
use function json_encode;
use const JSON_PRETTY_PRINT;
use function print_r;
use function redirect;
use function response;

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
            'stname' => [''],
            'barangay' =>[''],
            'city' => ['required', ''],
            'province' => ['required', ''],
            'country' => ['required', ''],
            'user_id' => '',
        ]);

        if (!Auth::user()->buyer()->exists()){

            if($validate){
                $buyer = Buyer::create(
                    [
                        'birthday' => $request->birthday,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'contact' =>  $request->contact,
                        'stnumber' =>  $request->stnumber,
                        'stname' =>  $request->stname,
                        'barangay' =>  $request->barangay,
                        'city' =>  $request->city,
                        'province' =>  $request->province,
                        'country' =>  $request->country,
                        'zip' =>  $request->zip,
                        'user_id' => auth()->user()->id,
                    ]
                );

                if($buyer->save()){
                    $buyer->user->delivery_addresses()->create([
                        'stnumber' =>  $request->stnumber,
                        'stname' =>  $request->stname,
                        'barangay' =>  $request->barangay,
                        'city' =>  $request->city,
                        'province' =>  $request->province,
                        'country' =>  $request->country,
                        'zip' =>  $request->zip,
                    ]);
                }

            }

        }



        return redirect(route('buyer.profile', Auth::user()->id))->with(['response' => 'success', 'message' => 'Seller info added']);
    }


    public function show(){

    }

    public function edit(){

        $buyer = Buyer::findOrFail(auth()->user()->buyer->id);
        $addresses = DeliveryAddress::all();

        return view('buyer/edit', compact(['buyer', 'addresses']));

    }

    public function update(Request $request){
        Auth::user()->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]
        );


       Buyer::where(['id' => auth()->user()->buyer->id]) -> update([
            'birthday' => $request->birthday,
            'age' => $request->age,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'stnumber' =>  $request->stnumber,
            'stname' =>  $request->stname,
            'barangay' =>  $request->barangay,
            'city' =>  $request->city,
            'province' =>  $request->province,
            'country' =>  $request->country,
            'zip' =>  $request->zip,
        ]);


        $buyer = Buyer::findOrFail( auth()->user()->buyer->id );

        return redirect(route('buyer.profile', compact(['buyer'])))->with(['message' => 'Buyer info Updated']);

        
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
                    'market_id' => 1,
                ];


                Auth::user()->seller()->create($data);



            }

        }

        session()->put('user_type', 'seller');
       return redirect(route('seller.profile'));
    }
}
