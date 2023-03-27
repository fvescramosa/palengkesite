<?php

namespace App\Http\Controllers\admin;

use App\AboutUs;
use App\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    //

    public function index(){

        $aboutUs = AboutUs::orderBy('id', 'DESC')->first();



        return view('admin.about-us.index', compact(['aboutUs']));
    }

    public function store(Request $request){



        $validate = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'url' => ['url'],
            'label' => [''],
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'label' => $request->label,
        ];

        if($request->image){

            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $directory = 'images/defaults/about-us/';
            $file->move(public_path($directory), $filename);
            $data['image'] = $directory.$filename;

        }else{
            $data['image'] = storage_path('public/images/defaults/logo-palengkesite.png');
        }


        $create = AboutUs::create($data);

        if($create->save()){
            $response = [
                'response' => 'success',
                'message' => 'About Us section updated!'
            ];
        }else{
            $response = [
                'response' => 'error',
                'message' => ''
            ];
        }


        return redirect(route('admin.about-us.index'))->with($response);
    }

    public function developers(){
        $developers = Developer::all();
//        $aboutUs =  AboutUs::all();

        return view('admin.about-us.show', compact(['developers']));
    }

    public function developers_create(){
        $developers = Developer::all();

        return view('admin.about-us.create', compact(['developers']));
    }

    public function developers_store(Request $request){
        $developers = Developer::all();

        $image = $request->image;
        $description = $request->description;

      /*  AboutUs::create([
            'image' => $image
            'description' => $description
        ]);*/

        $data = [
            'name' => $request->name,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,

        ];

        if ($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $directory = 'images/developers/';
            $file->move(public_path($directory), $filename);
            $data['photo']= $directory.$filename;
        }

        $create = Developer::create($data);

        if( $create->save()){
            $response = ['message' => 'Developer has been added', 'response'=> 'success'];
        }else{
            $response = ['message' => '', 'response' => 'error'];

        }

        return redirect(route('admin.developers'))->with($response);
    }

    public function developers_edit($id){
        $developer = Developer::find($id);

        return view('admin.about-us.edit', compact(['developer']));
    }

    public function developers_update(Request $request, $id){
        $developer = Developer::find($id);



        /*  AboutUs::create([
              'image' => $image
              'description' => $description
          ]);*/

        $data = [
            'name' => $request->name,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,

        ];

        if ($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $directory = 'images/developers/';
            $file->move(public_path($directory), $filename);
            $data['photo']= $directory.$filename;
        }

        $create = Developer::where('id', $id)->update($data);

        if( $create){
            $response = ['message' => 'Developer has been added', 'response'=> 'success'];
        }else{
            $response = ['message' => '', 'response' => 'error'];

        }

        return redirect(route('admin.developers'))->with($response);
    }
    public function showDeveloperTrash(){
        $developers = Developer::onlyTrashed()->get();



        return view('admin.about-us/trash', compact(['developers']));
    }

    public function deleteDeveloper($id){

        $delete =  Developer::where('id', $id)->delete();

        return redirect(route('admin.developers'));

    }

    public function recoverDeveloper($id){

        $recover = Developer::withTrashed()->where('id', $id)->restore();

        return redirect(route('admin.developers'));

    }

    public function DeveloperForceDelete($id){

        $delete = Developer::where('id', $id)->forceDelete();
        return redirect(route('admin.developers-trash'));
    }


}

