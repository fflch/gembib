<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class StlController extends Controller
{
    public function index(Request $request){

        $this->authorize('admin');

        if(empty($request->search)){
            $itens = Item::where("status","Em Processamento Técnico")->get();
        } else {
            $itens = Item::where("status","Em Processamento Técnico")->
                           where("titulo",'LIKE','%'.$request->search.'%')->get();
        }

        return view('stl.index',[
            'itens' => $itens
        ]);
    } 
}
