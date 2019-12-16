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
        "Esgotado",
        "Tombado",
    ];

    private $tipo_material = [
        "Livro",
        "Mapas",
        "Material Especial",
        "Memorial",  
        "Multimeios",
        "Obra rara",
        "Periódico",
        "CD/DVD",
        "Tese",
        "Outros Tipos"
    ];

    public function insercaoForm()
    {
        $this->authorize('sai');
        $areas = Area::all();
        $tipo_material = $this->tipo_material;
        return view('item/insercao', compact('areas','tipo_material'));
    }

    public function show(Request $request, Item $item)
    {
        $this->authorize('sai');
        return view('item/show', compact('item'));
    }

    public function insercao(Request $request)
    {
        $this->authorize('sai');
        $item = new Item;
        $item->adquirido_por = Auth::user()->codpes;

        Util::gravarNoBanco($request, $item);

        $data = Carbon::parse($item->data_tombamento);
        $dataformatada = $data->format('d/m/Y');

        $request->session()->flash('alert-info', 
            "Inserção direta enviada com sucesso em {$dataformatada}. 
            Novo status: {$item->status}");

        return redirect('/');
        
    }

}
