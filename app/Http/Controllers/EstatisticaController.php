<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class EstatisticaController extends Controller
{
    public function form(){
        $this->authorize('sai');
        $tipo_material = Item::tipo_material;
        $tipo_aquisicao = Item::tipo_aquisicao;
        $procedencia = Item::procedencia;
        return view('estatistica.form', compact('tipo_material', 'tipo_aquisicao', 'procedencia'));
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
        //pegando data no formato do calendário d-m-Y
        $inicio = $request->inicio;
        $fim = $request->fim;

        if($request->procedencia != null) {
            $query = $query->where('procedencia',$request->procedencia);   
        }

        if($request->tipo_aquisicao != null) {
            $query = $query->where('tipo_aquisicao',$request->tipo_aquisicao);   
        }

        if($request->tipo_material != null) {
            $query = $query->where('tipo_material',$request->tipo_material);   
        }

        $resultado = $query->count();
        $tipo_material = $request->tipo_material;
        $tipo_aquisicao = $request->tipo_aquisicao;
        $procedencia = $request->procedencia;
        
        return view('estatistica.view',compact('resultado','inicio', 'fim','tipo_material', 'tipo_aquisicao', 'procedencia'));
    }
}