<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;
use App\Http\Requests\ItemRequest;

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

    public function store(ItemRequest $request)
    {
        $this->authorize('sai');

        $item = new Item;
        $item->status = 'Em Tombamento';
        $item->insercao_por = Auth::user()->codpes;

        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->tombo = $request->tombo;
        $item->tombo_antigo = $request->tombo_antigo;
        $item->tipo_aquisicao = $request->tipo_aquisicao;
        $item->tipo_material = $request->tipo_material;
        $item->parte = $request->parte;
        $item->volume = $request->volume;
        $item->fasciculo = $request->fasciculo;
        $item->local = $request->local;
        $item->colecao = $request->colecao;
        $item->isbn = $request->isbn;
        $item->link = $request->link;
        $item->edicao = $request->edicao;
        $item->departamento = $request->departamento;
        $item->prioridade = $request->prioridade;
        $item->procedencia = $request->procedencia;
        $item->finalidade = $request->finalidade;
        $item->verba = $request->verba;
        $item->processo = $request->processo;
        $item->fornecedor = $request->fornecedor;
        $item->moeda = $request->moeda;
        $item->preco = $request->preco;
        $item->nota_fiscal = $request->nota_fiscal;
        $item->data_tombamento = Carbon::now();
        $item->data_sugestao = Carbon::now();
        $item->cod_impressao = $request->cod_impressao;
        $item->observacao = $request->observacao;
        $item->capes = $request->capes;
        $item->subcategoria = $request->subcategoria;

        $item->save();
        //$item = Util::gravarNoBanco($request, $item);

        $request->session()->flash('alert-info',"Inserção direta enviada com sucesso");

        return redirect("/item/{$item->id}");
    }

}
