<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProcessarController extends Controller
{
    private $status = [
        "Sugestão",
        "Negado",
        "Em cotação",
        "Em licitação",
        "Tombado",
    ];
    
    public function processarIndex()
    {
        $this->authorize('stl');
        $itens = item::all();
        return view('processar/index',compact('itens'));
    }

    public function processarForm(Item $item)
    {
        $this->authorize('stl');
        $status = $this->status;
        return view('processar/form',compact('item','status'));
    }

    public function processar(Request $request)
    {   

        $request->session()->flash('alert-info', "Sugestão processada com sucesso.");

        return redirect('/');
    }
}
