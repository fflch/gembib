<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Illuminate\Support\Facades\Auth;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Item;
use Carbon\Carbon;

class EstatisticaController extends Controller
{
    public function form(){
        $this->authorize('sai');
        return view('estatistica.form');
    }

//Livros - compra - nacional  
    public function show(Request $request, Item $item){
        $this->authorize('sai');
        $request->validate([
            'inicio'  => 'required',
            'fim'   => 'required',
        ]);

        /* Selecionando todos itens */
        $query = Item::all();

        /* Filtrando datas */
        // convertendo de dd/mm/yyyy para yyyy-mm-dd
        $inicio = implode("-",array_reverse(explode('/',$request->inicio)));
        $fim = implode("-",array_reverse(explode('/',$request->fim)));

        $inicio = Carbon::parse($inicio);
        $fim = Carbon::parse($fim);

        $query = $query->where('created_at','>=',$inicio);
        $query = $query->where('created_at','<=',$fim);

        /* Filtros */
        if($request->procedencia != null) {
            $query = $query->where('procedencia',$request->procedencia);   
        }

        if($request->tipo_aquisicao != null) {
            $query = $query->where('tipo_aquisicao',$request->tipo_aquisicao);   
        }

        $resultado = $query->count();
        return view('estatistica.view',compact('resultado'));
    }
}