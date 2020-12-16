<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

        if (!empty($request->status)) {
            $query->where(function ($p) use (&$request) {
                $p->where('status','=',$request->status);
            });
        }

        if (!empty ($request->procedencia)) {
            $query->where(function ($s) use (&$request) {
                $s->where('procedencia','=',$request->procedencia)
                  ->orwhere('procedencia','=',$request->procedencia);
            });
        }

        if (!empty($request->busca)) {
            $query->where(function ($q) use (&$request) {
                $q->where('titulo','LIKE', '%' . $request->busca . '%')
                  ->orWhere('autor','LIKE', '%' . $request->busca . '%')
                  ->orwhere('tombo','LIKE', '%' . $request->busca . '%')
                  ->orwhere('cod_impressao','LIKE', '%' . $request->busca . '%');
            });
        }

        if (!empty($request->data_sugestao_inicio) && !empty($request->data_sugestao_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_sugestao_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_sugestao_fim);
            $query->whereBetween('data_sugestao', [$from, $to]);
            $query->whereNotNull('data_sugestao');
        }

        if (!empty($request->data_processamento_inicio) && !empty($request->data_processamento_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_processamento_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_processamento_fim);
            $query->whereBetween('data_processamento', [$from, $to]);
            $query->whereNotNull('data_processamento');
        }

        if (!empty($request->data_tombamento_inicio) && !empty($request->data_tombamento_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_tombamento_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_tombamento_fim);
            $query->whereBetween('data_tombamento', [$from, $to]);
            $query->whereNotNull('data_tombamento');
        }

        return $query;
    }

    public function index(Request $request)
    {
        $this->authorize('sai');
        $status = $this->status;
        $procedencia = $this->procedencia;
        $query = $this->search();

        $q = clone $query;
        $sugestao = $q->where('status', 'Sugestão')->count();

        $q = clone $query;
        $cotacao = $q->where('status', 'Em Cotação')->count();

        $q = clone $query;
        $licitacao = $q->where('status', 'Em Licitação')->count();

        $q = clone $query;
        $tombamento = $q->where('status', 'Em Tombamento')->count();

        $q = clone $query;
        $negado = $q->where('status', 'Negado')->count();

        $q = clone $query;
        $tombado = $q->where('status', 'Tombado')->count();

        $q = clone $query;
        $processamento = $q->where('status', 'Em Processamento Técnico')->count();

        $q = clone $query;
        $processado = $q->where('status', 'Processado')->count();

        $itens = $query->paginate(10);
        return view('item/index',compact('itens','status','procedencia', 'sugestao', 'cotacao', 'licitacao', 'tombamento','negado', 'tombado', 'processamento','processado', 'query'));
    }

    public function create()
    {
        $this->authorize('sai');
        return view('item/create')->with('item', new Item);
    }

    public function show(Request $request, Item $item)
    {
        $this->authorize('sai');
        $area = Area::where('codigo', $item->capes)->first();
        return view('item/show', compact('item', 'area'));
    }

    public function store(ItemRequest $request)
    {   
        $this->authorize('sai');

        $validated = $request->validated();

        $validated['status'] = 'Em Tombamento';
        $validated['insercao_por'] = Auth::user()->codpes;
        $validated['alterado_por'] = Auth::user()->codpes;
        $validated['data_tombamento'] = Carbon::now();
        $validated['data_sugestao'] = Carbon::now();

        $item = Item::create($validated);

        $item->save();

        $request->session()->flash('alert-info',"Inserção direta enviada com sucesso");

        return redirect("/item/{$item->id}");
    }
    
    public function excel(Excel $excel){
        $query = $this->search();
        $q = clone $query;
        if($q->count() > 10000){
            request()->session()->flash('alert-danger',"Não foi possível baixar o arquivo, 
            limite de 10000 registros excedido");
            return redirect('/item');
        }
        
        $headings = ['isbn','titulo','autor','editora','data_sugestao','data_tombamento'];
        $campos = ['ISBN', 'Título', 'Autor', 'Editora', 'Data de sugestão', 'Data de tombamento'];
        $itens = $query->get($headings)->toArray();
        $export = new ExcelExport($itens,$campos);
        return $excel->download($export, 'busca.xlsx');
    }

}
