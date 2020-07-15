<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;
use App\Http\Requests\ItemRequest;

use Maatwebsite\Excel\Excel;
use App\Exports\ExcelExport;

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

    public function index(Request $request)
    {
        $this->authorize('sai');
        $status = $this->status;
        $procedencia = $this->procedencia;
        $query = $this->search();
        $itens = $query->paginate(10);
        return view('item/index',compact('itens','status','procedencia'));
    }

    public function excel(Excel $excel){
        $query = $this->search();
        $headings = ['isbn','titulo','autor','editora','data_sugestao','data_tombamento'];
        $campos = ['ISBN', 'Título', 'Autor', 'Editora', 'Data de sugestão', 'Data de tombamento'];
        $itens = $query->get($headings)->toArray();
        $export = new ExcelExport($itens,$campos);
        return $excel->download($export, 'busca.xlsx');
    }

    public function create()
    {
        $this->authorize('sai');
        return view('item/create')->with('item', new Item);
    }

    public function show(Request $request, Item $item, Area $area)
    {
        $this->authorize('sai');
        return view('item/show', compact('item', 'area'));
    }

    public function store(ItemRequest $request)
    {   
        $this->authorize('sai');

        $validated = $request->validated();

        $validated['status'] = 'Em Tombamento';
        $validated['insercao_por'] = Auth::user()->codpes;
        $validated['data_tombamento'] = Carbon::now();
        $validated['data_sugestao'] = Carbon::now();

        $item = Item::create($validated);

        $item->save();

        $request->session()->flash('alert-info',"Inserção direta enviada com sucesso");

        return redirect("/item/{$item->id}");
    }

}
