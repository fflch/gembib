<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;

class ItemController extends Controller
{
    private $status = [
        "Sugestão",
        "Negado",
        "Em cotação",
        "Em licitação",
        "Tombado",
    ];

    public function insercaoForm()
    {
        $this->authorize('logado');
        $areas = Area::all();
        return view('item/insercao', compact('areas'));
    }

    public function show(Request $request, Item $item)
    {
        $this->authorize('logado');
        return view('item/show', compact('item'));
    }

    public function insercao(Request $request)
    {
        $this->authorize('logado');
        $item = new Item;

        Util::gravarNoBanco($request, $item);

        $data = Carbon::parse($item->data_tombamento);
        $dataformatada = $data->format('d/m/Y');
        $request->session()->flash('alert-info', "Inserção direta enviada com sucesso em {$dataformatada}. Novo status: {$item->status}");

        return redirect('/');
        
    }

}
