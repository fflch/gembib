<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Illuminate\Support\Facades\Auth;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Item;
use DB;

class EstatisticaController extends Controller
{
    public function form(){
        $this->authorize('sai');
        return view('estatisticas');
    }

//Livros - compra - nacional  
    public function show(Request $request, Item $item){
    	$this->authorize('sai');
        $query = DB::table('itens')->where('tipo_material', 'Outros tipos')->get();
        return view('teste', compact($query));
    }
}