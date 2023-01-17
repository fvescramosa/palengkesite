<?php

namespace App\Http\Controllers\Admin;

use App\User;
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
        $users = User::where('user_type_id', '2');

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

        return view('admin.users/buyers', compact(['users']));
    }

    public function showSellerList(){

       

        $users = User::where('user_type_id', '1');

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

    public function delete($id){

        $user_type = User::find($id)->user_type_id;
       $delete =  User::where('id', $id)->delete();

    //   dd( $delete );

   

        if($user_type == 2){
            return redirect(route('admin.show.buyers.list'));
        }else{
            return redirect(route('admin.show.sellers.list')); 
        }
    }
}
