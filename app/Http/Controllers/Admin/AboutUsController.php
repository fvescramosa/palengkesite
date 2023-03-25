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
        $developers = Developer::all();
//        $aboutUs =  AboutUs::all();

        return view('admin.about-us.show', compact(['developers']));
    }

    public function create(){
        $developers = Developer::all();

        return view('admin.about-us.create', compact(['developers']));
    }

    public function store(Request $request){
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

        return redirect(route('admin.about-us'))->with($response);
    }

    public function edit($id){
        $developer = Developer::find($id);

        return view('admin.about-us.edit', compact(['developer']));
    }

    public function update(Request $request, $id){
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

        return redirect(route('admin.about-us'))->with($response);
    }
    public function showDeveloperTrash(){
        $developers = Developer::onlyTrashed()->get();



        return view('admin.about-us/trash', compact(['developers']));
    }

    public function deleteDeveloper($id){

        $delete =  Developer::where('id', $id)->delete();

        return redirect(route('admin.about-us'));

    }

    public function recoverDeveloper($id){

        $recover = Developer::withTrashed()->where('id', $id)->restore();

        return redirect(route('admin.about-us'));

    }

    public function DeveloperForceDelete($id){

        $delete = Developer::where('id', $id)->forceDelete();
        return redirect(route('admin.developers-trash'));
    }
}

