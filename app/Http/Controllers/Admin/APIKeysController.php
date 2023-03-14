<?php

namespace App\Http\Controllers\Admin;

use App\Keys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIKeysController extends Controller
{
    //


    public function index()
    {

        $keys = Keys::all();
        return view('admin.apikeys.index', compact(['keys']));
    }

    public function create(){
        return view('admin.apikeys.create');
    }

    public function edit(){
        return view('admin.apikeys.edit');
    }

    public function update(){

        $response = [];
        return redirect(route('admin.api.index'))->with($response);
    }

    public function store(Request $request){

        $request->validate([
            'label' => ['required'],
            'keys' => ['required'],
        ]);

        $data = [
            'label' => $request->label,
            'keys' => $request->keys,
        ];

        $keys = Keys::create($data);

        if($keys->save()){
            $response = ['success' => 'success', 'message' => 'Success'];
        }else{
            $response = ['success' => 'error', 'message' => 'Failed!'];
        }

        return redirect(route('admin.api.index'))->with($response);
    }
}
