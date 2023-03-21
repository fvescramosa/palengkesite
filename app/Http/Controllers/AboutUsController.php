<?php

namespace App\Http\Controllers;

use App\Developer;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //

    public function index(){
        $developers = Developer::all();
        return view('about-us', compact(['developers']));
    }
}
