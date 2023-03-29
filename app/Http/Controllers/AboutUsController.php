<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\Developer;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //

    public function index(){

        $about = AboutUs::orderBy('id', 'DESC')->first();
        $developers = Developer::all();
        return view('about-us', compact(['developers' , 'about']));
    }
}
