<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function show(){
        $categories = Categories::all();
        return view('admin.categories.show', compact(['categories']));
    }


    public function create(){
        return view('admin.categories.create');
    }


    public function store( Request $request){


        $validate = $request->validate([
            'image' => "required|mimes:jpeg,jpg,png"
        ]);

        $data = [
            'category' => $request->category
        ];
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$request->category.'.'.$request->file('image')->extension();
            $file->move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }

        $category = Categories::create($data);



        if($category->save()){
            $message = [
                'success' => true,
                'message' => 'Category added!'
            ];
        }else{
            $message = [
                'success' => false,
                'message' => 'Failed'
            ];
        }

        return redirect(route('admin.categories.show'))->with($message);
    }


    public function edit($id){
        $category = Categories::findOrFail($id);
        return view('admin.categories.edit', compact(['category']));
    }


    public function update($id, Request $request){

        $data = [
            'category' => $request->category,
        ];
        if($request->file('image') != null){
            $file= $request->file('image');
            $filename= date('YmdHi').$request->category.'.'.$request->file('image')->extension();
            $file-> move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }

        $category = Categories::where('id', $id)
            ->update($data);

        if($category){
            $message = ['success' => true, 'message' => 'Update Successful!'];
        }else{
            $message = ['success' => false, 'message' => 'Update failed!'];
        }

        $categories = Categories::all();
        return redirect(route('admin.categories.show'))->with($message);
    }
}
