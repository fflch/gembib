<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('aluno');
        
        $itens = Item::where('status', 'Em Processamento Técnico');
        return view ('pedido.index',[
            'itens' => $itens->paginate(10),
        ]);
    }
}
