<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
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
        $category = Categories::create($request->all());

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

        $category = Categories::where('id', $id)
            ->update([ 'category' => $request->category]);

        if($category){
            $message = ['success' => true, 'message' => 'Update Successful!'];
        }else{
            $message = ['success' => false, 'message' => 'Update failed!'];
        }

        $categories = Categories::all();
        return redirect(route('admin.categories.show'))->with($message);
    }
}
