<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Item;

class RelatorioController extends Controller
{
    public function form(){
        $this->authorize('sai');
        return view('relatorios');
    }

    public function show(Request $request){
    	$this->authorize('sai');
    	$request->validate([
                'cod_impressao'  => 'required'
            ]);
    	
        $itens = Item::where('cod_impressao', $request->cod_impressao)->get();
        return view ('show', compact('itens'));
    }
}