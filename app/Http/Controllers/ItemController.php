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
    private $status = Item::status;
    private $procedencia = Item::procedencia;

    private function search(){
        $request =  request();
        $query = Item::orderBy('created_at', 'desc');

        if (isset($request->status) && !empty($request->status)) {
            $query->where(function ($p) use (&$request) {
            $p->where('status','=',$request->status);
            });
        }

        if (isset($request->procedencia) && !empty ($request->procedencia)) {
            $query->where(function ($s) use (&$request) {
            $s->where('procedencia','=',$request->procedencia)
              ->orwhere('procedencia','=',$request->procedencia);
            });
        }

        if (isset($request->busca) && !empty($request->busca)) {
            $query->where(function ($q) use (&$request) {
                $q->where('titulo','LIKE', '%' . $request->busca . '%')
                  ->orWhere('autor','LIKE', '%' . $request->busca . '%')
                  ->orwhere('tombo','LIKE', '%' . $request->busca . '%')
                  ->orwhere('cod_impressao','LIKE', '%' . $request->busca . '%');
            });
        }

        return $query;
    }

    public function index()
    {
        $this->authorize('sai');
        $status = $this->status;
        $procedencia = $this->procedencia;
        $query = $this->search();
        $itens = $query->paginate(10);
        return view('item/index',compact('itens','status','procedencia'));
    }

    public function create()
    {
        $this->authorize('sai');
        return view('item/create')->with('item', new Item);
    }

    public function show(Request $request, Item $item)
    {
        $this->authorize('sai');
        return view('item/show', compact('item'));
    }

    public function store(Request $request)
    {
        $this->authorize('sai');

        $item = new Item;
        $item->status = 'Em Tombamento';
        $item->insercao_por = Auth::user()->codpes;

        $item = Util::gravarNoBanco($request, $item);

        $request->session()->flash('alert-info',"Inserção direta enviada com sucesso");

        return redirect("/item/{$item->id}");

    }

}
