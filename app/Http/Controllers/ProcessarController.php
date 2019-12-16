<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;

class ProcessarController extends Controller
{
    private $status = [
        "Sugestão",
        "Negado",
        "Em cotação",
        "Em licitação",
        "Tombado",
    ];
    
    public function processarIndex(Request $request)
    {

        $this->authorize('sai');
        $status = $this->status;

        $query = Item::orderBy('titulo', 'desc');

        if (isset($request->busca) && !empty($request->busca)) {
            $query->where('titulo','LIKE', '%' . $request->busca . '%');
        } 

        if (isset($request->status) && !empty($request->status)) {
            $query->where('status','=',$request->status);
        } 

        $itens = $query->get();

        return view('processar/index',compact('itens','status'));
    }

    public function processarForm(Item $item)
    {
        $this->authorize('sai');
        $status = $this->status;
        $areas = Area::all();
        return view('processar/form',compact('item','status','areas'));
    }

    public function processar(Request $request, Item $item)
    {   
        $this->authorize('sai');
        Util::gravarNoBanco($request, $item);
        $request->session()->flash('alert-info', "Sugestão processada com sucesso.");

        return redirect('/');
    }
}
