<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\User;
use App\DeliveryAddress;
use function dd;
use function extract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function json_decode;
use function json_encode;
use const JSON_PRETTY_PRINT;
use function print_r;
use function redirect;
use function response;

class BuyerController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'profile_image' => 'required|mimes:jpeg,jpg,png',
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
                        'longitude' =>  $request->longitude,
                        'latitude' =>  $request->latitude,
                        'user_id' => auth()->user()->id,
                        'profile_image' => $request->profile_image,
                    ]
                );

                /*if($request->file('image')){
                    $file= $request->file('image');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/Image'), $filename);
                    $data['image']= $filename;
                }*/


                if ($request->file('profile_image')){

                    $image = $request->profile_image;
                    $fileName = $image->getClientOriginalName();
                    $directory = auth()->user()->id . "/profile";
                    $imageStoreResult = Storage::disk('public')->put($directory, $image);
                    $data['profile_image']= $imageStoreResult;

                    $buyer->user()->update($data);

                }

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






        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ];


       $buyer = Buyer::where(['id' => auth()->user()->buyer->id]) -> update([
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
            'longitude' =>  $request->longitude,
            'latitude' =>  $request->latitude,
            'image'	=> $request->image,
        ]);

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').'.'.$request->file('image')->extension();
            $file-> move(public_path('public/Image'), $filename);
            $buyer['image']= $filename;
        }


        if ($request->file('profile_image')){
            $validate = $request->validate(
                [
                    'profile_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
                ]
            );
            $file= $request->file('profile_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $directory = 'public/images/profile/'.auth()->user()->id.'/';
            $file->move(public_path($directory), $filename);
            $userData['profile_image']= $directory.$filename;

        }


        Auth::user()->update($userData);

        $buyer = Buyer::findOrFail( auth()->user()->buyer->id );

        return redirect(route('buyer.profile', compact(['buyer'])))->with(['message' => 'Buyer info Updated', 'response' => 'success']);

        
    }

    public function switch_as_seller(){

        if(Auth::user()->user_type_id == 1){


            Auth::user()->update(['user_type_id' => 2]);

            if(!Auth::user()->buyer()->exists()){
                return redirect(route('seller.create'));
            }
            else if(!Auth::user()->seller()->exists()){
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
