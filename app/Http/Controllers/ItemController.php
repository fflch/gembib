<?php

namespace App\Http\Controllers;

use App\Models\User;
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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(Request $request){
        if ($request->search) {
            $query = Item::where('status','Em Processamento Técnico')->where(function ($q) use (&$request) {
                $q->where('titulo','LIKE', '%' . $request->search . '%')
                  ->orWhere('autor','LIKE', '%' . $request->search . '%')
                  ->orwhere('tombo', $request->search)
                  ->orwhere('cod_impressao','LIKE', '%' . $request->search . '%');
            });
        }
        return view('index', [
            'itens' => $request->search ? $query->paginate(10) : [],
            'request'=> $request
        ]);
    }

    public function viewPrioridade(){
        $this->authorize('ambos');

        $itens = User::join('itens', 'users.email','itens.pedido_usuario')
        ->where('itens.status','Em Processamento Técnico')
        ->toBase()
        ->get();

        return view('item.prioridades.index', ['itens' => $itens]);
    }


    public function create(){
        $this->authorize('ambos');
        return view('item/create')->with('item', new Item);
    }

    public function show(Item $item){
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
        return redirect("/sai");
    }

    public function set_is_active(Request $request){
        $this->authorize('ambos');

        $request->validate([
            'is_active' => 'required|bool',
            'tombo' => 'required',
        ]);
        if(!$request->is_active){//se for para desativar, setar is_active para 0/false
            $request->validate(['motivo_desativamento' => 'required|max:500']);
            $item = Item::where('tombo', $request->tombo)->update(['is_active' => $request->is_active, 'motivo_desativamento' => $request->motivo_desativamento, 'status' => 'Inativo']);
            request()->session()->flash('alert-success','Item desativado com sucesso.');
        }else{
            $item = Item::where('tombo', $request->tombo)->update(['is_active' => $request->is_active, 'motivo_desativamento' => "", 'status' => 'Tombado']);
            request()->session()->flash('alert-success','Item reativado com sucesso.');
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
        request()->session()->flash('alert-success','Etiqueta de Lombada atualizada');
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
