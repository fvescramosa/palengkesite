<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Seller;
use App\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(){
        $users = User::all();

        return view('admin.users/users', compact(['users']));
    }

    public function showBuyer(){
        $users = User::whereHas('buyer');

        if(isset($_GET['search'])){
            $users = $users->where( function($query){
                $query->orwhere('first_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('last_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('email', 'like', '%' . $_GET['search'] . '%');
            });
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['first_name', 'asc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['first_name', 'desc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['first_name', 'asc'];
            $users->orderBy($orderby[0], $orderby[1]);
        }

        $users = $users->paginate(10);

        return view('admin.users/buyers', compact(['users']));
    }

    public function showSellerList(Request $request){

        $users = User::whereHas('seller')->whereHas('seller.seller_stalls', function($q){

                if(isset($_GET['stall']) && $_GET['stall'] != ''){
                    $q->where('status', $_GET['stall']);
                }

                if(isset($_GET['contract'])){
                    if($_GET['contract'] == 'end') {
                        $q->whereDate('end_date', '<=', Carbon::now());

                    }else if($_GET['contract'] == 'active'){
                        $q->whereDate('end_date', '>=', Carbon::now());
                    }
                }

        });

        if(isset($_GET['search'])){
            $users = $users->where( function($query){
                $query->orwhere('first_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('last_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('email', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('seller', function($q){
                    $q->where('seller_type', 'like', '%' . $_GET['search'] . '%');
                });
            });
        }

        if(session()->has('market')){

            $marketOption = session()->get('market');

            $users->whereHas('seller', function($q) use ($marketOption){
                    $q->where('market_id', $marketOption);
            });

           
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['first_name', 'asc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['first_name', 'desc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['first_name', 'asc'];
            $users->orderBy($orderby[0], $orderby[1]);
        }





        $users = $users->paginate(10);
        
        return view('admin.users/sellers', compact(['users', 'request']));
    }

    public function  showSellerTrash(){
        $sellers = Seller::with('user')->onlyTrashed()
        ->select('sellers.*')
        ->join('users', 'sellers.user_id', '=', 'users.id');

        if(isset($_GET['search'])){
            $sellers = $sellers->where( function($query){
                $query->orwhereHas('user', function($q){
                    $q->where('first_name', 'like', '%' . $_GET['search'] . '%');
                    $q->orwhere('last_name', 'like', '%' . $_GET['search'] . '%');
                    $q->orwhere('email', 'like', '%' . $_GET['search'] . '%');
                });
                $query->orwhere('gender', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('seller_type', 'like', '%' . $_GET['search'] . '%');
            });
        }


        if(session()->has('market')){

            $marketOption = session()->get('market');

            $sellers->where('sellers.market_id', $marketOption);
        

        }
        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['users.first_name', 'asc'];
                $sellers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['users.first_name', 'desc'];
                $sellers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['sellers.deleted_at', 'desc'];
                $sellers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['sellers.deleted_at', 'asc'];
                $sellers->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['users.first_name', 'asc'];
            $sellers->orderBy($orderby[0], $orderby[1]);
        }

        $sellers = $sellers->paginate(10);

        return view('admin.users/trash', compact(['sellers']));
    }

    public function  showBuyerTrash(){
        
        $buyers = Buyer::with('user')->onlyTrashed()
        ->select('buyers.*')->join('users', 'buyers.user_id', '=', 'users.id');

        if(isset($_GET['search'])){
            $buyers = $buyers->where( function($query){
                $query->orwhere('first_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('last_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('email', 'like', '%' . $_GET['search'] . '%');
            });
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['users.first_name', 'asc'];
                $buyers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['users.first_name', 'desc'];
                $buyers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['buyers.deleted_at', 'desc'];
                $buyers->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['buyers.deleted_at', 'asc'];
                $buyers->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['users.first_name', 'asc'];
            $buyers->orderBy($orderby[0], $orderby[1]);
        }

        $buyers = $buyers->paginate(10);

        return view('admin.users/buyers-trash', compact(['buyers']));
    }

    public function showSeller($id){

        $user = User::findOrFail($id);

        //dd($user->seller->seller_stalls()->get());
        return view('admin.users.sellerdetails', compact(['user']));

    }

    public function edit($id){
        $user = User::findOrFail($id);

        // dd($users);
        return view('admin.users.edit', compact(['user']));
    }

    public function update($id, Request $request){
        
        $data =  [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            
        ];

        if($request->password != ""){
            $data['password'] = Hash::make($request->password);
        }

        $user = User::where('id', $id)->update(
           $data
        );

        $user_type = User::find($id)->user_type_id;

        if($user_type == 2){
            return redirect(route('admin.show.buyers.list'));
        }else{
            return redirect(route('admin.show.sellers.list')); 
        }

    }

    public function deleteSeller($id){

       
        $delete =  Seller::where('user_id', $id)->delete();

        if($delete){
            $response = ['response' => 'success', 'message' => 'Seller was successfully deleted!'];
        }else{
            $response = ['response' => 'error', 'message' => 'Seller was not deleted!'];
        }

        return response()->json($response);
//        return redirect(route('admin.show.sellers.list'))->with($response);

    }

    public function deleteBuyer($id){

       
        $delete =  Buyer::where('user_id', $id)->delete();



        if($delete){
            $response = ['response' => 'success', 'message' => 'Buyer was successfully deleted!'];
        }else{
            $response = ['response' => 'error', 'message' => 'Buyer was not deleted!'];
        }

        return response()->json($response);
//        return redirect(route('admin.show.buyers.list'));
        
    }

    public function recoverSeller($id){

        $recover = Seller::withTrashed()->where('id', $id)->restore();       


        return redirect(route('admin.show.sellers.list'));
        
    }

    public function recoverBuyer($id){

        $recover = Buyer::withTrashed()->where('id', $id)->restore();       


        return redirect(route('admin.show.buyers.list'));
        
    }

    public function SellerForceDelete($id){
        
        $delete = Seller::where('id', $id)->forceDelete();
        return redirect(route('admin.show.sellers.trash'));
    }

    public function BuyerForceDelete($id){
        
        $delete = Buyer::where('id', $id)->forceDelete();
        return redirect(route('admin.show.buyers.trash'));
    }

    public function exportSeller(){
        $users = User::whereHas('seller')->whereHas('seller.seller_stalls', function($q){

            if(isset($_GET['stall']) && $_GET['stall'] != ''){
                $q->where('status', $_GET['stall']);
            }

            if(isset($_GET['contract'])){
                if($_GET['contract'] == 'end') {
                    $q->whereDate('end_date', '<=', Carbon::now());

                }else if($_GET['contract'] == 'active'){
                    $q->whereDate('end_date', '>=', Carbon::now());
                }
            }

        });


        if(isset($_GET['search'])){
            $users = $users->where( function($query){
                $query->orwhere('first_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('last_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhere('email', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('seller', function($q){
                    $q->where('seller_type', 'like', '%' . $_GET['search'] . '%');
                });
            });
        }

        if(session()->has('market')){

            $marketOption = session()->get('market');

            $users->whereHas('seller', function($q) use ($marketOption){
                $q->where('market_id', $marketOption);
            });


        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['first_name', 'asc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['first_name', 'desc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $users->orderBy($orderby[0], $orderby[1]);
            }

        }
        else{
            $orderby = ['first_name', 'asc'];
            $users->orderBy($orderby[0], $orderby[1]);
        }





        $users = $users->get();

        $fileName = 'sellers.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );




        $columns = array('First Name',
                        'Last Name',
                        'Email',
                        'Stall Number',
                        'End of Contract',
        );

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($users as $data) {
                $row['First Name']  = $data->first_name;
                $row['Last Name']    = $data->last_name;
                $row['Email']    = $data->email;
                $row['Stall Number']    = $data->seller->seller_stalls->name;
                $row['Status']    = $data->seller->seller_stalls->status;
                $row['End of Contract']    = $data->seller->seller_stalls->end_date;

                $row['Contract Status'] = '';
                if(isset($_GET['contract']) &&  $_GET['contract']== 'end'){
                    $row['Contract Status']    = 'Expired';
                }else if(isset($_GET['contract']) &&  $_GET['contract']== 'active'){
                    $row['Contract Status']    = 'Active';
                }

                fputcsv($file, array(
                    $row['First Name'],
                    $row['Last Name'] ,
                    $row['Email'],
                    $row['Stall Number'],
                    $row['Status'],
                    $row['End of Contract'],
                    $row['Contract Status'],
                ));

            }
            fclose($file);
        };


        return response()->stream($callback, 200, $headers);

    }
}
