<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryAddressController extends Controller
{
    //

    public function create(){
        return view('buyer.delivery_address.create');
    }

    public function store(Request $request, $type = null){

       /* if($type == 'main'){
            auth()->user()->buyer->update([
                'stnumber' =>  $request->stnumber,
                'stname' =>  $request->stname,
                'barangay' =>  $request->barangay,
                'city' =>  $request->city,
                'province' =>  $request->province,
                'country' =>  $request->country,
                'zip' =>  $request->zip,
            ]);
        }else{*/
            auth()->user()->delivery_addresses()->create([
                'stnumber' =>  $request->stnumber,
                'stname' =>  $request->stname,
                'barangay' =>  $request->barangay,
                'city' =>  $request->city,
                'province' =>  $request->province,
                'country' =>  $request->country,
                'zip' =>  $request->zip,
            ]);
       /* }*/

        $reponse = ['response' => 'success', 'message' => 'Address Added'];

        return redirect(route('buyer.profile', ['id' => auth()->user()->id]))->with($reponse);
    }


}
