<?php

namespace App\Http\Controllers;

use App\User;
use function compact;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function profile($id){
        $user = User::findOrFail($id);

       return view('buyer.profile', compact(['user']));
    }


}
