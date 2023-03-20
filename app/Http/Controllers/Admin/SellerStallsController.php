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
                    $q->orwhereHas('market', function($qr){
                        $qr->where('market', 'like', '%' . $_GET['search'] . '%');
                    });
                });
                $query->orwhereHas('stall', function($q){
                    $q->where('number', 'like', '%' . $_GET['search'] . '%');
                    $q->orwhere('section', 'like', '%' . $_GET['search'] . '%');
                });
                $query->orwhere('status', 'like', '%' . $_GET['search'] . '%');
            });
        }

        $stalls = $stalls->select('seller_stalls.*')->join('sellers', 'seller_stalls.seller_id', '=', 'sellers.id')
        ->join('users', 'users.id', '=', 'sellers.user_id');

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['users.first_name', 'asc'];

            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['users.first_name', 'desc'];

            }
            else if($_GET['orderby'] == 'recent'){
                $orderby = ['seller_stalls.created_at', 'desc'];

            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['seller_stalls.created_at', 'asc'];

            }
            
        }else{
            $orderby = ['users.first_name', 'asc'];

        }

        $stalls->orderBy($orderby[0], $orderby[1]);

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
                $response = ['message', 'Success!', 'response' => 'success'];
                return redirect(route('admin.seller.stalls.show'))->with($response);
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
                $directory = 'data/contracts/sellers/'.$request->seller_stall_id.'/';
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move($directory, $filename);
                $data['contact_of_lease']= $directory.$filename;
                $data['status']= 'active';


                $seller_stall = SellerStall::findOrFail($id);

                $seller_stall->update($data);

                $update = $seller_stall->stall()->update(['status' => 'occupied']);

                if($update){
                    $response = ['message', 'Done!', 'response' => 'success'];
                }else{
                    $response = ['message', 'Something went wrong.', 'response' => 'error'];
                }
            }else{
                $response = '';
            }


        }


        return redirect(route('admin.seller.stalls.show'))->with($response);

    }
}
