<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private function search(){
        $request = request();
        $query = Item::where('status', 'Em Processamento Técnico')->orderBy('created_at', 'desc');     

        if(isset($request->titulo)) {
            $query->where('titulo',$request->titulo);
        }

        if(isset($request->autor)) {
            $query->where('autor',$request->autor);
        }
        
        if(isset($request->editora)) {
            $query->where('editora',$request->editora);
        }

        if(isset($request->ano)) {
            $query->where('ano',$request->ano);
        }

        return $query;
    }

    public function create(Request $request)
    {
        $this->authorize('aluno');
        $query = $this->search();
        $itens = $query->paginate(10);
        
        return view ('pedido.create',[
            'itens' => $itens,
            'query' => $query,
        ]);
    }

    public function pedidoItem(Request $request)
    {
        if($request->session()->has('itens')){

            $itens = $request->session()->get('itens');
            $itens->push($request->item);
            $request->session()->put('itens', $itens);
            dd('teste');

        }else{
            $itens = collect([$request->item]);
            $request->session()->put('itens', $itens);
            dd('testeelse');
        }

    }
}
