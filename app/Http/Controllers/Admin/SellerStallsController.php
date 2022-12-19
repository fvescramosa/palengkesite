<?php

namespace App\Http\Controllers\Admin;

use App\SellerStall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerStallsController extends Controller
{
    //
    public function index(){
        $stalls = SellerStall::with(['seller', 'seller.user', 'stall'])->get();

        return view('admin/seller/stalls/index', compact(['stalls']));

    }

    public function approve(Request $request){

        $seller_stalls = SellerStall::where(['status' => 'Pending'])->findOrFail($request->seller_stall_id);
        $data = [];
        if($seller_stalls){
            $data['status'] = 'active';

            if($seller_stalls->update($data)){

                $seller_stalls->stall->update(['status' => 'occupied']);
                return redirect(route('admin.seller.stalls.show'))->with(['message'. '']);
            }


        }else{
            return false;
        }





    }

    public function uploadContract(Request $request){

        $validate = $request->validate([
            "contract_of_lease" => "required|mimes:pdf|max:10000",
        ]);

        if($validate){
            $id = $request->seller_stall_id;
            $data = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'duration' => $request->duration,
                'occupancy_fee' => $request->occupancy_fee,
            ];


            if($request->file('contract_of_lease')){
                $file= $request->file('contract_of_lease');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/contracts'), $filename);
                $data['contact_of_lease']= $filename;
                $data['status']= 'active';


                SellerStall::where('id', $id)->update($data);

            }

        }

        return redirect(route('admin.seller.stalls.show'))->with('message', 'Done!');

    }
}
