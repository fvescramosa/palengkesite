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
    public function show(Request $request){



        $stalls = new Stall();

        if(isset($_GET['search'])){
            $stalls = $stalls->where(function ($query){
                $query->orWhere('number', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('section', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('status', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('market', function($q){
                    $q->where('market', 'like', '%' . $_GET['search'] . '%');
                });

            });
        }

        if(session()->has('market')){
            $stalls = $stalls->Where('market_id', session()->get('market'));
        }

        if(isset($_GET['status']) && $_GET['status'] != ''){
            $stalls = $stalls->where('status', $_GET['status']);
        }

            //->get();
        // $orderby = '';

        // if(isset($_GET['orderby'])){
        //     if($_GET['orderby'] == 'A-Z'){
        //         $orderby = ['number', 'asc'];
        //         $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        //     }

        //     else if($_GET['orderby'] == 'Z-A'){
        //         $orderby = ['number', 'desc'];
        //         $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        //     }

        //     else if($_GET['orderby'] == 'recent'){
        //         $orderby = ['created_at', 'desc'];
        //         $stalls = $stalls->orderBy($orderby[0], $orderby[1]);
        //     }

        //     else if($_GET['orderby'] == 'oldest'){
        //         $orderby = ['created_at', 'asc'];
        //         $stalls = $stalls->orderBy($orderby[0], $orderby[1]);
        //     }
            
        // }
        // else{
        //     $orderby = ['number', 'asc'];
        //     $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        // }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['number', 'asc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['number', 'desc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['number', 'asc'];
            $stalls->orderBy($orderby[0], $orderby[1]);
        }


        $stalls = $stalls->paginate(10);
        
        return view('admin.stalls/show', compact(['stalls', 'request']));
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

        $validate = $request->validate([
            'stall_number' => 'required',
            'sqm'	=> 'required',
            'amount_sqm' => 'required',
            'rental_fee'	=> 'required',
            'section'	=> 'required',
            'rate' => '',
            'coordinates' => 'required',
            'meter_number' => 'required',
            'market' => 'required',
            'image'	=> 'required|mimes:jpeg,jpg,png',
            'annual_fee' => 'required',
        ]);

        $data = [
            'number' => $request->stall_number,
            'sqm'	=> $request->sqm,
            'amount_sqm' => $request->amount_sqm,
            'rental_fee'	=> $request->rental_fee,
            'section'	=> $request->section,
            'market_id'	=> $request->market, //market from name
            'image'	=> $request->image,
            'status' => 'vacant',
            'rate' => $request->rate,
            'coords' => $request->coordinates,
            'meter_num' => $request->meter_number,
            'category_id' => Categories::where('category', $request->section)->first()->id,
            'annual_fee' => $request->annual_fee,
        ];

  
        if($request->file('image')){
            $file= $request->file('image');
            $directory = 'images/stalls/'.$request->stall_number.'/';
            $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image.'.$file->getExtension();
            $file->move($directory, $filename);
            $data['image']=$directory.$filename;
        }


        if($request->file('image_1')){
            $file= $request->file('image_1');
            $directory = 'images/stalls/'.$request->stall_number.'/';
            $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image1.'.$file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $data['image_1']=$directory.$filename;
        }


        if($request->file('image_2')){
            $file= $request->file('image_2');
            $directory = 'images/stalls/'.$request->stall_number.'/';
            $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image2.'.$file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $data['image_2']=$directory.$filename;
        }


        if($request->file('image_3')){
            $file= $request->file('image_3');
            $directory = 'images/stalls/'.$request->stall_number.'/';
            $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image3.'.$file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $data['image_3']=$directory.$filename;
        }

        if($request->file('image_4')){
            $file= $request->file('image_4');
            $directory = 'images/stalls/'.$request->stall_number.'/';
            $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image4.'.$file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $data['image_4']=$directory.$filename;
        }

        if($request->file('image_5')){
            $file= $request->file('image_5');
            $directory = 'images/stalls/'.$request->stall_number.'/';
            $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image5.'.$file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $data['image_5']=$directory.$filename;
        }


        $stalls = Stall::create(
            $data
        );

        if($stalls->save()){
            return redirect(route('admin.stalls.show'))->with(['message' => 'Stall has been added', 'response' => 'success']);
        }else{
            return redirect(route('admin.stalls.show'))->with(['message' => 'Failed to add', 'response' => 'error']);
        }

    }

    public function edit($id){
        $markets = Market::all();
        $categories = Categories::all();
        $stalls = Stall::findOrFail($id);


        return view('admin.stalls.edit', compact(['stalls', 'markets', 'categories']));
    }

    public function update($id, Request $request){

        $data =  [
            'number' => $request->number,
            'sqm'	=> $request->sqm,
            'amount_sqm' => $request->amount_sqm,
            'rental_fee'	=> $request->rental_fee,
            'section'	=> $request->section,
            'market_id'	=> $request->market,
//            'image'	=> $request->image,
//            'image_1' => $request->image_1,
//            'image_2' => $request->image_2,
//            'image_3' => $request->image_3,
//            'image_4' => $request->image_4,
//            'image_5' => $request->image_5,
            'status' => $request->status,
            'rate' => $request->rate,
            'coords' => $request->coords,
            'meter_num' => $request->meter_num,
            'annual_fee' => $request->annual_fee,
        ];


            $directory = 'images/stalls/'.$request->number.'/';
            if($request->file('image')){
                $file= $request->file('image');

                $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image.'.$file->getClientOriginalExtension();

//                dd($directory.$filename);
                $file->move($directory, $filename);
                $data['image']=$directory.$filename;

            }
    
    
            if($request->file('image_1')){
                $file= $request->file('image_1');

                $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image1.'.$file->getExtension();
                $file->move($directory, $filename);
                $data['image_1']=$directory.$filename;
            }
    
    
            if($request->file('image_2')){
                $file= $request->file('image_2');

                $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image2.'.$file->getExtension();
                $file->move($directory, $filename);
                $data['image_2']=$directory.$filename;
            }
    
    
            if($request->file('image_3')){
                $file= $request->file('image_3');

                $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image3.'.$file->getExtension();
                $file->move($directory, $filename);
                $data['image_3']=$directory.$filename;
            }
    
            if($request->file('image_4')){
                $file= $request->file('image_4');

                $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image4.'.$file->getExtension();
                $file->move($directory, $filename);
                $data['image_4']=$directory.$filename;
            }
    
            if($request->file('image_5')){
                $file= $request->file('image_5');

                $filename= date('YmdHi').'_'.uniqid().'_'.$request->stall_number.'_'.'image5.'.$file->getExtension();
                $file->move($directory, $filename);
                $data['image_5']=$directory.$filename;
            }


        $stalls = Stall::where('id', $id)->update(
            $data
        );
        if($stalls){
            return redirect(route('admin.stalls.show'))->with(['message' => 'Stall has been updated', 'response' => 'success']);
        }else{
            return redirect(route('admin.stalls.show'))->with(['message' => 'Failed to update', 'response' => 'error']);
        }
    }

    public function trash(){
        $stalls = Stall::with('market')->onlyTrashed();
        
        if(isset($_GET['search'])){
            $stalls = $stalls->where(function ($query){
                $query->orWhere('number', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('section', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('status', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('market', function($q){
                    $q->where('market', 'like', '%' . $_GET['search'] . '%');
                });

            });
        }

        if(session()->has('market')){
            $stalls = $stalls->Where('market_id', session()->get('market'));
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

        return view('admin.stalls/trash', compact(['stalls']));
    }

    public function deleteStall($id){

       
        $delete =  Stall::where('id', $id)->delete();


        return redirect(route('admin.stalls.show')); 
        
    }

    public function recoverStall($id){

        $recover = Stall::withTrashed()->where('id', $id)->restore();       


        return redirect(route('admin.stalls.show'));
        
    }

    public function StallForceDelete($id){
        
        $delete = Stall::where('id', $id)->forceDelete();
        return redirect(route('admin.stalls.trash'));
    }


    public function exportStall($status = null){


        $fileName = 'Stalls-'.date('F-d-Y-h-i-a').'.csv';

        $stalls = new Stall();

        if(session()->has('market')){
            $stalls = $stalls->where('market_id', session()->get('market'));
        }


        if(isset($_GET['search'])){
            $stalls = $stalls->where(function ($query){
                $query->orWhere('number', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('section', 'like', '%' . $_GET['search'] . '%');
                $query->orWhere('status', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('market', function($q){
                    $q->where('market', 'like', '%' . $_GET['search'] . '%');
                });

            });
        }

        if(isset($_GET['status']) && $_GET['status'] != ''){
            $stalls = $stalls->where('status', $_GET['status']);
        }
        //->get();
        // $orderby = '';

        // if(isset($_GET['orderby'])){
        //     if($_GET['orderby'] == 'A-Z'){
        //         $orderby = ['number', 'asc'];
        //         $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        //     }

        //     else if($_GET['orderby'] == 'Z-A'){
        //         $orderby = ['number', 'desc'];
        //         $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        //     }

        //     else if($_GET['orderby'] == 'recent'){
        //         $orderby = ['created_at', 'desc'];
        //         $stalls = $stalls->orderBy($orderby[0], $orderby[1]);
        //     }

        //     else if($_GET['orderby'] == 'oldest'){
        //         $orderby = ['created_at', 'asc'];
        //         $stalls = $stalls->orderBy($orderby[0], $orderby[1]);
        //     }

        // }
        // else{
        //     $orderby = ['number', 'asc'];
        //     $stalls = $stalls->orderByRaw('CONVERT('.$orderby[0].', SIGNED) '.$orderby[1]);
        // }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['number', 'asc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['number', 'desc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $stalls->orderBy($orderby[0], $orderby[1]);
            }

        }
        else{
            $orderby = ['number', 'asc'];
            $stalls->orderBy($orderby[0], $orderby[1]);
        }




        $stalls = $stalls->get();



        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );




        $columns = array('Stall Number',
                        'SQM',
                        'Amount Per SQM',
                        'Rental Fee',
                        'Rate',
                        'Coordinates',
                        'Meter Number',
                        'Section',
                        'Status',
                    );

        $callback = function() use($stalls, $columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($stalls as $data) {
                $row['Stall Number']  = $data->number;
                $row['SQM']    = $data->sqm;
                $row['Amount Per SQM']    = $data->amount_sqm;
                $row['Rental Fee']    = $data->rental_fee;
                $row['Rate']    = $data->rate;
                $row['Coordinates']    = $data->coords;
                $row['Meter Number']    = $data->meter_num;
                $row['Section']    = $data->section;
                $row['Status']    = $data->status;
                fputcsv($file, array(
                    $row['Stall Number'],
                    $row['SQM'] ,
                    $row['Amount Per SQM'],
                    $row['Rental Fee'],
                    $row['Rate'],
                    $row['Coordinates'],
                    $row['Meter Number'],
                    $row['Section'],
                    $row['Status'],
                ));

            }
            fclose($file);
        };


        return response()->stream($callback, 200, $headers);

//        dd([$labels, $data ]);


//        return view('seller.analytics.order-by-products', compact('labels', 'data'));
    }
}
