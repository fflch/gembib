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
    private $status = Util::status;
    
    public function processarIndex(Request $request)
    {
        $this->authorize('sai');
        $status = $this->status;

        $query = Item::orderBy('created_at', 'desc');
        
        /* 
        if (isset($request->busca) && !empty($request->busca)) {
            $query->where('tombo','LIKE', '%' . $request->busca . '%');
        }*/

        if (isset($request->status) && !empty($request->status)) {
            $query->where('status','=',$request->status);
        } 

        if (isset($request->busca) && !empty($request->busca)) {
            $query->where(function ($q) use (&$request) {
                $q->where('titulo','LIKE', '%' . $request->busca . '%')
                  ->orWhere('autor','LIKE', '%' . $request->busca . '%')
                  ->orwhere('tombo','LIKE', '%' . $request->busca . '%')
                  ->orwhere('cod_impressao','LIKE', '%' . $request->busca . '%');
            });
        } 
        
        $itens = $query->paginate(10);

        return view('processar/index',compact('itens','status'));
    }

    public function processarForm(Item $item)
    {
        $this->authorize('sai');
        $status = $this->status;
        $areas = Area::all();
        $tipo_material = Util::tipo_material;
        return view('processar/form',compact('item','status','areas','tipo_material'));
    }

    public function processar(Request $request, Item $item)
    {   
        $this->authorize('sai');
        Util::gravarNoBanco($request, $item);
        $request->session()->flash('alert-info', "Sugestão processada com sucesso.");

        return redirect('/');
    }
}
