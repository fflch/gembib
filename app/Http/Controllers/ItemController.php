<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ItemRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ItemController extends Controller
{
    private $status = Item::status;
    private $procedencia = Item::procedencia;
    private $tipo_material = Item::tipo_material;
    private $tipo_aquisicao = Item::tipo_aquisicao;

    private function search(){
        $request = request();
        $query = Item::orderBy('created_at', 'desc');
        
        if(isset($request->titulo)) {
            $query->where('titulo','LIKE', '%'.$request->titulo.'%');
        }
        
        if(isset($request->autor)) {
            $query->where('autor','LIKE', '%'.$request->autor.'%');
        }

        if(isset($request->tombo)) {
            $query->where('tombo',$request->tombo);
        }

        if(isset($request->observacao)) {
            $query->where('observacao','LIKE', '%'.$request->observacao.'%');
        }

        if(isset($request->verba)) {
            $query->where('verba',$request->verba);
        }

        if(isset($request->processo)) {
            $query->where('processo',$request->processo);
        }

        if(isset($request->codigoimpressao)) {
            $query->where('cod_impressao',$request->codigoimpressao);
        }

        if(isset($request->is_active)) {
            $query->where(function ($q) use (&$request) {
                $q->where('is_active',$request->is_active == '1');
            });
        }
        
        if (!empty($request->status)) {
            
            $query->where(function ($p) use (&$request) {
                $p->where('status','=',$request->status);
            });
        }

        if (!empty($request->procedencia)) {
            $query->where(function ($s) use (&$request) {
                $s->where('procedencia','=',$request->procedencia)
                  ->orwhere('procedencia','=',$request->procedencia);
            });
        }

        if (!empty($request->tipo_material)) {
            $query->where(function ($t) use (&$request) {
                $t->where('tipo_material','=',$request->tipo_material)
                  ->orwhere('tipo_material','=',$request->tipo_material);
            });
        }

        if (!empty($request->tipo_aquisicao)) {
            $query->where(function ($a) use (&$request) {
                $a->where('tipo_aquisicao','=',$request->tipo_aquisicao)
                  ->orwhere('tipo_aquisicao','=',$request->tipo_aquisicao);
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

    private function quantidades($query){
        $quantidades = [];

        $q = clone $query;
        $quantidades['sugestao'] = $q->where('status', 'Sugestão')->count();

        $q = clone $query;
        $quantidades['cotacao'] = $q->where('status', 'Em Cotação')->count();

        $q = clone $query;
        $quantidades['licitacao'] = $q->where('status', 'Em Licitação')->count();

        $q = clone $query;
        $quantidades['tombamento'] = $q->where('status', 'Em Tombamento')->count();

        $q = clone $query;
        $quantidades['negado'] = $q->where('status', 'Negado')->count();

        $q = clone $query;
        $quantidades['tombado'] = $q->where('status', 'Tombado')->count();

        $q = clone $query;
        $quantidades['processamento'] = $q->where('status', 'Em Processamento Técnico')->count();

        $q = clone $query;
        $quantidades['processado'] = $q->where('status', 'Processado')->count();
        return $quantidades;
    }

    public function index(Request $request)
    {
        $this->authorize('ambos');
        $query = $this->search();
        $quantidades = $this->quantidades($query);
        $itens = $query->paginate(10);

        return view('item/index', [
            'itens'          => $itens,
            'status'         => $this->status,
            'quantidades'    => $quantidades,
            'procedencia'    => $this->procedencia,
            'tipo_material'  => $this->tipo_material,
            'tipo_aquisicao' => $this->tipo_aquisicao,
            'query'          => $query
            ]);
    }

    public function indexPublic(Request $request)
    {
        $query = Item::orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $query->where('is_active', 1)->where(function ($q) use (&$request) {
                $q->where('titulo','LIKE', '%' . $request->search . '%')
                  ->orWhere('autor','LIKE', '%' . $request->search . '%')
                  ->orwhere('tombo','LIKE', '%' . $request->search . '%')
                  ->orwhere('cod_impressao','LIKE', '%' . $request->search . '%');
            });
        }
        $quantidades = $this->quantidades($query);
        $itens = $query->paginate(10);
    	return view('index',[
            'quantidades' => $quantidades,
            'itens' => $itens
        ]);
    }

    public function create()
    {
        $this->authorize('ambos');
        return view('item/create')->with('item', new Item);
    }

    public function show(Request $request, Item $item)
    {
        $this->authorize('ambos');
        $area = Area::where('codigo', $item->capes)->first();
        return view('item/show', compact('item', 'area'));
    }

    public function store(ItemRequest $request)
    {
        $this->authorize('ambos');

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

    public function edit(Item $item){
        $this->authorize('ambos');

        return view('item.edit')->with('item',$item);

    }

    public function update(ItemRequest $request, Item $item){
        $this->authorize('ambos');

        $validated = $request->validated();

        $validated['alterado_por'] = Auth::user()->codpes;

        $item->update($validated);

        $request->session()->flash('alert-info',"Item atualizado com sucesso");
        return redirect("/item/{$item->id}");

    }


    public function destroy(Item $item)
    {
        $this->authorize('ambos');
        if($item->status == 'Em Tombamento' ){
            $item->delete();
            request()->session()->flash('alert-info','Item excluído com sucesso.');
        }else{
            request()->session()->flash('alert-danger','Não é possível excluir um item tombado, apenas desativá-lo.');
        }
        return redirect("/item");
    }

    public function set_is_active(Request $request){
        $this->authorize('ambos');
        $request->validate([
            'is_active' => 'required|bool',
            'tombo' => 'required',
        ]);

        if(!$request->is_active){//se for para desativar, setar is_active para 0/false
            $request->validate(['motivo_desativamento' => 'required|max:500']);
            $item = Item::where('tombo', $request->tombo)->update(['is_active' => $request->is_active, 'motivo_desativamento' => $request->motivo_desativamento]);
            request()->session()->flash('alert-success','Item desativado com sucesso.');
        }else{
            $item = Item::where('tombo', $request->tombo)->update(['is_active' => $request->is_active, 'motivo_desativamento' => ""]);
            request()->session()->flash('alert-success','Item ativado com sucesso.');
        }
        return back();

    }

    public function duplicar(Request $request){
        $this->authorize('ambos');
        $request->validate([
            'itemId' => 'required',
        ]);

        $newItem = Item::where('id', $request->itemId)->first()->replicate();
        $newItem->created_at = Carbon::now();
        $newItem->tombo = null;
        $newItem->status = 'Em Tombamento';
        $newItem->save();

        request()->session()->flash('alert-success','Item clonado com sucesso.');
    
        return redirect("/item/{$newItem->id}");

    }

    

    public function excel(){
        $query = $this->search();
        $q = clone $query;
        if($q->count() > 10000){
            request()->session()->flash('alert-danger',"Não foi possível baixar o arquivo,
            limite de 10000 registros excedido");
            return redirect('/item');
        }
        $export = new FastExcel($query->get());
        return $export->download(date("YmdHi").'gembib.xlsx');
    }

    public function etiqueta_update(Request $request, Item $item){
        $this->authorize('ambos');

        if ($request->filled('no_classificacao') or
            $request->filled('no_cutter') or $request->filled('exemplar')) {
                $item->update($request->only([
                    'no_classificacao',
                    'no_cutter',
                    'exemplar',
                ]));
        }

        #return para o method da etiqueta
        return redirect("/item/{$item->id}");

    }
}
