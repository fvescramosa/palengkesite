<?php

namespace App\Http\Controllers\Admin;

use App\Stall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StallsController extends Controller
{
    //
    public function show(){

        $stalls = Stall::all();

        return view('admin.stalls/show', compact(['stalls']));
    }

    public function find($id){
        $stall = Stall::findOrFail($id);

        return view('admin.stalls/find', compact(['stall']));
    }

    public function create(){
        return view('admin/stalls/create');
    }

    public function store(Request $request){

        $data = [
            'number' => $request->number,
            'sqm'	=> $request->sqm,
            'amount_sqm' => $request->amount_sqm,
            'rental_fee'	=> $request->rental_fee,
            'section'	=> $request->section,
            'market'	=> $request->market,
            'image'	=> $request->image,
            'status' => 'vacant',
        ];

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }


        if($request->file('image_1')){
            $file= $request->file('image_1');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_1']= $filename;
        }


        if($request->file('image_2')){
            $file= $request->file('image_2');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_2']= $filename;
        }


        if($request->file('image_3')){
            $file= $request->file('image_3');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_3']= $filename;
        }

        if($request->file('image_4')){
            $file= $request->file('image_4');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_4']= $filename;
        }

        if($request->file('image_5')){
            $file= $request->file('image_5');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_5']= $filename;
        }


        $stalls = Stall::create(
            $data
        );

        if($stalls->save()){
            $message = ['success' => true, 'message' => 'Stall added'];
        }else{
            $message = ['success' => false, 'message' => 'Stall added failed'];
        }

        return redirect(route('admin.stalls.show'))->with($message);
    }

    public function edit($id){
        $stalls = Stall::findOrFail($id);

        return view('admin.stalls.edit', compact(['stalls']));
    }

    public function update($id, Request $request){
        $stalls = Stall::where('id', $id)->update(
            [
                'number' => $request->number,
                'sqm'	=> $request->sqm,
                'amount_sqm' => $request->amount_sqm,
                'rental_fee'	=> $request->rental_fee,
                'section'	=> $request->section,
                'market'	=> $request->market,
                'image'	=> $request->image,
                'status' => $request->status,
            ]
        );

        if($stalls){
            $message = ['success' => true, 'message' => 'Stall updated'];
        }else{
            $message = ['success' => false, 'message' => 'Stall update failed'];
        }

        return redirect(route('admin.stalls.show'))->with($message);
    }
}
