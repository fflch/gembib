<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;
use PDF;
use App\Http\Requests\ItemRequest;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Mail;
use App\Mail\mail_prioridade;
use App\Mail\mail_processado;

class ItemController extends Controller
{
    private $status = Item::status;
    private $procedencia = Item::procedencia;
    private $tipo_material = Item::tipo_material;
    private $tipo_aquisicao = Item::tipo_aquisicao;

    private function search(){
        $request = request();
        $query = Item::orderBy('created_at', 'desc')
        ->where('is_active',1)
        ->where('titulo','LIKE',"%".$request->search."%")
        ->orWhere('autor','LIKE','%'.$request->search.'%')
        ->orWhere('tombo',$request->search)
        ->orWhere('cod_impressao','like','%'.$request->search.'%');

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
            $query->whereBetween('data_processado', [$from, $to]);
            $query->whereNotNull('data_processado');
        }

        if (!empty($request->data_tombamento_inicio) && !empty($request->data_tombamento_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_tombamento_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_tombamento_fim);
            $query->whereBetween('data_tombamento', [$from, $to]);
            $query->whereNotNull('data_tombamento');
        }

        return $query;
    }

    private function quantidades($busca){
        $quantidades = [];

        $q = clone $busca->toBase()->get();
        $quantidades['processamento'] = $q->where('status', 'Em Processamento Técnico')->count();

        return $quantidades;
    }

    public function indexPublic(Request $request){
        $query = Item::orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $query->where('status','Em Processamento Técnico')->where(function ($q) use (&$request) {
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
            'itens' => $itens,
        ]);
    }

    public function prioridadeJustificativa(Item $item){
        $this->authorize('user');
        $item = Item::where('id',$item->id)->first();
        return view('item.prioridades.justificativa', ['item' => $item]);
    }
    
    public function pedirPrioridade(Item $item, Request $request){
        $this->authorize('user');
        $item->justificativa_processamento = $request->justificativa_processamento;
        $item->pedido_usuario = Auth::user()->email; //email de quem pediu a prioridade
        $item->prioridade_processamento = 1;
        $item->save();
        if($item->pedido_usuario){
            Mail::queue(new mail_prioridade($item));
        }
        request()->session()->flash('alert-info','Prioridade pedida');
        return redirect("/");
    }
    
    public function prioridadeView(Request $request){
        $this->authorize('ambos');

        $itens = Item::where('prioridade_processamento',1)
        ->where('status','Em Processamento Técnico')
        ->toBase();

        $itens->when(!$request->busca, function($itens){
            return $itens->where('prioridade_processamento',1)
            ->where('status','Em Processamento Técnico');
        });

        $itens->when($request->busca, function($itens) use ($request){
            return $itens->where('titulo','like','%'.$request->busca.'%')
            ->orwhere('autor','like','%'.$request->busca.'%')
            ->orwhere('isbn',$request->busca)
            ->where('status','Em Processamento Técnico');
        });
        

        return view('item.prioridades.index', ['itens' => $itens->paginate(5)]);
    }

    public function aceitarProcessamentoItem(Request $request, Item $item){
        $item->status = "Processado";
        $item->update();
        Mail::queue(new mail_processado($item));
        request()->session()->flash('alert-info',"Status do item de tombo $item->tombo mudado para PROCESSADO");
        return redirect('/prioridades');
    }

    public function index(Request $request){

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

    public function create(){
        $this->authorize('ambos');
        return view('item/create')->with('item', new Item);
    }

    public function show(Request $request, Item $item){
        $this->authorize('ambos');
        $area = Area::where('codigo', $item->capes)->first();
        return view('item/show', compact('item', 'area'));
    }

    public function store(ItemRequest $request){
        $this->authorize('ambos');

        $validated = $request->validated();

        $validated['status'] = 'Tombado';
        $validated['insercao_por'] = Auth::user()->codpes;
        $validated['alterado_por'] = Auth::user()->codpes;
        $validated['data_tombamento'] = Carbon::now();
        $validated['tombo'] = Item::max('tombo') + 1;
        $item = Item::create($validated);
        $item->save();

        $item->alterado_por = Auth::user()->codpes;
        $item->update($validated);

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
        if($request->data_tombamento_nova != null){
            $validated['data_tombamento'] = Carbon::createFromFormat('d/m/Y', $request->data_tombamento_nova)->format('Y-m-d');
        }
        if($request->data_processamento_novo != null){
            $validated['data_processamento'] = Carbon::createFromFormat('d/m/Y', $request->data_processamento_novo)->format('Y-m-d');
        }
        if($request->data_processado_novo != null){
            $validated['data_processado'] = Carbon::createFromFormat('d/m/Y', $request->data_processado_novo)->format('Y-m-d');
        }

        $item->update($validated);

        $request->session()->flash('alert-info',"Item atualizado com sucesso");
        return redirect("/item/{$item->id}");

    }


    public function destroy(Item $item){
        $this->authorize('ambos');
        if($item->tombo == NULL ){
            $item->delete();
            request()->session()->flash('alert-info','Item excluído com sucesso.');
        }else{
            request()->session()->flash('alert-danger','Não é possível excluir um item que possua Tombo.');
        }
        return redirect("/");
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

    public function imprimir(Item $item) {
        $pdf = PDF::loadView('pdfs.imprimir_item', compact('item'));
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        //A função abaixo serve para colocar o marcador de página na relatorioSTL
        $canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->download('imprimir_item.pdf',[
            'item' => $item,
        ]);
    }
}
