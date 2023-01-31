<?php

namespace App\Http\Controllers\Admin;

use App\SellerStall;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerStallsController extends Controller
{
    //
    public function index(){

        
        $stalls = SellerStall::with(['seller', 'seller.user', 'stall'])
                            ->whereHas('seller')
                            ->whereHas('stall',function($q){
                                            if(session()->has('market')){
                                                if(session()->get('market') != ''){
                                                    $q->where('market_id', session()->get('market'));
                                                }    
                                            }
                                        }
                                    );

        // if(session()->has('market')){
        //     $stalls = $stalls->whereHas([ 'stall' => function($q){
        //         $q->where('market_id', session()->get('market'));
        //     }]);
        // }

        if(isset($_GET['search'])){
            $stalls = $stalls->where( function($query){
                $query->orwhereHas('seller', function($q){
                    $q->whereHas('user', function($qr){
                        $qr->where('first_name', 'like', '%' . $_GET['search'] . '%');
                        $qr->orwhere('last_name', 'like', '%' . $_GET['search'] . '%');
                    });
                });
                $query->orwhereHas('stall', function($q){
                    $q->where('number', 'like', '%' . $_GET['search'] . '%');
                    $q->orwhere('section', 'like', '%' . $_GET['search'] . '%');
                });
                $query->orwhere('status', 'like', '%' . $_GET['search'] . '%');
            });
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['seller.user.first_name', 'asc'];
                $sellers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['seller.user.first_name', 'desc'];
                $sellers->orderBy($orderby[0], $orderby[1]);
            }
            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }
            
        }
       

        $stalls = $stalls->paginate(10);


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
