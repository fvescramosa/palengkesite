<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function show(){
        $categories = new Categories();

        if(isset($_GET['search'])){
            $categories = $categories->where(function ($query){
                $query->orWhere('category', 'like', '%' . $_GET['search'] . '%');
            });
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['category', 'asc'];
                $categories->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['category', 'desc'];
                $categories->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $categories->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $categories->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['category', 'asc'];
            $categories->orderBy($orderby[0], $orderby[1]);
        }

        $categories = $categories->get();

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
            'category' => $request->category,
            'slug' => Str::slug($request->category)
        ];




        if($request->file('image')){
            $file= $request->file('image');
            $directory = 'images/admin/categories/'.Str::slug($request->category).'/';
            $filename= date('YmdHi').Str::slug($request->category).'.'.$request->file('image')->extension();
            $file->move($directory, $filename);
            $data['image']= $directory.$filename;

        }
        $category = Categories::create($data);

        if($category->save()){
            return redirect(route('admin.categories.show'))->with(['message' => 'Category has been added', 'response' => 'success']);

        }else{
            return redirect(route('admin.categories.show'))->with(['message' => 'Category failed to add', 'response' => 'error']);
        }

    }


    public function edit($id){
        $category = Categories::findOrFail($id);
        return view('admin.categories.edit', compact(['category']));
    }


    public function update($id, Request $request){

        $data = [
            'category' => $request->category,
            'slug' => Str::slug($request->category)
        ];
        if($request->file('image') != null){
            $file= $request->file('image');
            $directory = 'images/admin/categories/'.Str::slug($request->category).'/';
            $filename= date('YmdHi').Str::slug($request->category).'.'.$request->file('image')->extension();
            $file-> move($directory, $filename);
            $data['image']= $directory.$filename;
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

    public function trash(){
        $categories = Categories::onlyTrashed()->get();



        return view('admin.categories/trash', compact(['categories']));
    }

    public function deleteCategory($id){

        $delete =  Categories::where('id', $id)->delete();

        return redirect(route('admin.categories.show'));

    }

    public function recoverCategory($id){

        $recover = Categories::withTrashed()->where('id', $id)->restore();

        return redirect(route('admin.categories.show'));

    }

    public function CategoryForceDelete($id){

        $delete = Categories::where('id', $id)->forceDelete();
        return redirect(route('admin.categories.trash'));
    }
}
