<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Stall;
use App\Market;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StallsController extends Controller
{
    //
    public function show(){

        $stalls = new Stall();

        if(session()->has('market')){
            $stalls = $stalls->Where('market_id', session()->get('market'));
        }


        if(isset($_GET['search'])){
            $stalls = $stalls->where( function ($query){
                $query->orWhere('number', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('section', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('status', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('market', function($q){
                    $q->where('market', 'like', '%' . $_GET['search'] . '%');
                });


            });
        }

            //->get();
        $orderby = '';

        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['number', 'asc'];
                $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['number', 'desc'];
                $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $stalls = $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $stalls = $stalls->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['number', 'asc'];
            $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        }



        $stalls = $stalls->paginate(10);
        
        return view('admin.stalls/show', compact(['stalls']));
    }

    public function find($id){
        $stall = Stall::findOrFail($id);

        return view('admin.stalls/find', compact(['stall']));
    }

    public function create(){
        $markets = Market::all();
        $categories = Categories::all();

        return view('admin/stalls/create', compact(['markets', 'categories']));
    }

    public function store(Request $request){

        $data = [
            'number' => $request->number,
            'sqm'	=> $request->sqm,
            'amount_sqm' => $request->amount_sqm,
            'rental_fee'	=> $request->rental_fee,
            'section'	=> $request->section,
            'market_id'	=> $request->market, //market from name
            'image'	=> $request->image,
            'status' => 'vacant',
            'rate' => $request->rate,
            'coords' => $request->coords,
            'meter_num' => $request->meter_num,
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
        $markets = Market::all();
        $stalls = Stall::findOrFail($id);


        return view('admin.stalls.edit', compact(['stalls', 'markets']));
    }

    public function update($id, Request $request){
        $stalls = Stall::where('id', $id)->update(
            [
                'number' => $request->number,
                'sqm'	=> $request->sqm,
                'amount_sqm' => $request->amount_sqm,
                'rental_fee'	=> $request->rental_fee,
                'section'	=> $request->section,
                'market_id'	=> $request->market,
                'image'	=> $request->image,
                'status' => $request->status,
                'rate' => $request->rate,
                'coords' => $request->coords,
                'meter_num' => $request->meter_num,
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
