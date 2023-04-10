<?php

namespace App\Http\Controllers\Admin;

use App\Market;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketsController extends Controller
{
    //
    public function show(){
        $markets = Market::all();
        return view('admin.markets.show', compact(['markets']));
    }

    public function create(){
        return view('admin.markets.create');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'market' => "required"
        ]);

        $data = [
            'market' => $request->market,
        ];

        $market = Market::create($data);

        if($market->save()){
            return redirect(route('admin.markets.show'))->with(['message' => 'Market has been added', 'response' => 'success']);

        }else{
            return redirect(route('admin.markets.show'))->with(['message' => 'Market failed to add', 'response' => 'error']);
        }


    }

    public function edit($id){
        $market = Market::findOrFail($id);
        return view('admin.markets.edit', compact(['market']));
    }

    public function update($id, Request $request){
        $data = [
            'market' => $request->market
        ];

        $market = Market::where('id', $id)->update(
            $data
        );

        if($market){
            $message = ['success' => true, 'message' => 'Market updated'];
        }else{
            $message = ['success' => false, 'message' => 'Market update failed'];
        }

        return redirect(route('admin.markets.show'))->with($message);
    }

}
