<?php

namespace App\Http\Controllers\Admin;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete($id){

        $delete =  Seller::where('user_id', $id)->delete();

        return redirect(route('admin.show.sellers.list'));

    }

    public function retrieve($id){

        $user_type = User::withTrashed()->find($id)->user_type_id;


        $recover =  User::where('id', $id)->restore();

        //   dd( $delete );

        if($user_type == 2){
            return redirect(route('admin.show.buyers.list'));
        }else{
            return redirect(route('admin.show.sellers.list'));
        }
    }
}
