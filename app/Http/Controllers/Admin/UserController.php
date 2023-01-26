<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Seller;
use App\Buyer;
use Illuminate\Http\Request;
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

    public function showSellerList(){

        $users = User::whereHas('seller')->whereHas('seller.seller_stalls', function($q){
            $q->where('status', 'active');
        });

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

        
        return view('admin.users/sellers', compact(['users']));
    }

    public function  showSellerTrash(){
        $sellers = Seller::with('user')->onlyTrashed()
        ->select('sellers.*')
        ->join('users', 'sellers.user_id', '=', 'users.id');


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

        $sellers = $sellers->get();

        return view('admin.users/trash', compact(['sellers']));
    }

    public function  showBuyerTrash(){
        
        $buyers = Buyer::with('user')->onlyTrashed()
        ->select('buyers.*')->join('users', 'buyers.user_id', '=', 'users.id');

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

        $buyers = $buyers->get();


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


        return redirect(route('admin.show.sellers.list')); 
        
    }

    public function deleteBuyer($id){

       
        $delete =  Buyer::where('user_id', $id)->delete();


        return redirect(route('admin.show.buyers.list')); 
        
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
}
