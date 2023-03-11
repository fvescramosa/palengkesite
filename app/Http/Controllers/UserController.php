<?php

namespace App\Http\Controllers;

use App\User;
use function compact;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function route;

class UserController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile(){



        $user = auth()->user();

        if(session('user_type') == 'seller'){
            return redirect(route('seller.profile'));

        }else if(session('user_type') == 'buyer'){
            if(!$user->buyer()->exists()){
                return redirect(route('buyer.create'));
            }else{
                return view('buyer.profile', compact(['user']));
            }
        }

    }


}
