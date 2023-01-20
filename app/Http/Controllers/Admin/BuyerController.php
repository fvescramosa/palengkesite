<?php

namespace App\Http\Controllers\Admin;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerController extends Controller
{
    //

    public function delete($id){


        $delete =  Buyer::where('user_id', $id)->delete();

        return redirect(route('admin.show.buyers.list'));

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
