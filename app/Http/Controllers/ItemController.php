<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    /* Etapa 1 - Sugestão */
    public function index()
    {
        // select * from item where status="Sugestão"
        $this->authorize('logado');
        $itens = item::where('status',"Sugestão")->get();
        return view('itens/index',compact('itens'));
    }

    public function create()
    {
        $this->authorize('logado');
        return view('itens/create');
        $user = new User;
    }

    public function store(Request $request)
    {
        $this->authorize('logado');
        $request->validate([
            'titulo'  => 'required',
            /* 'autor'   => 'required', */
            /* 'editora' => 'required', */
        ]);

        /* pegar itens que estão chegando e salvar no banco de dados */
        $item = new Item;
        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->sugerido_por_id = Auth::id();

        $item->status = "Sugestão";
        $item->save();

        $request->session()->flash('alert-info', 'Sugestão enviada com sucesso');

        return redirect('/');
    }


    /* Etapa 2 - Processar Sugestão */
    public function processar_sugestao(Item $item)
    {
        $this->authorize('stl');
        return view('itens/processar_sugestao',compact('item'));
    }

    public function store_processar_sugestao(Request $request, Item $item)
    {
        $this->authorize('stl');
        if($request->status == 'Negado') {
            $request->validate([
                'motivo'  => 'required',
            ]);
            $item->motivo = $request->motivo;
        }
        /* Alterar status */
        $item->status = $request->status;
        $item->save();

        $request->session()->flash('alert-info',"Sugestão processada, novo status: {$item->status}");

        return redirect('/itens');
    }

    /* Etapa 3 - Processar aquisição */
    public function processar_tombamento(item $tombamento)
    {
        $this->authorize('sai');
        $areas = Area::all();
        return view('itens/processar_tombamento',compact('tombamento','areas'));
    }

    public function store_processar_tombamento(Request $request, item $tombamento)
    {
        /* Validação de campos */
        $this->authorize('sai');
        $request->validate([
            'titulo'           => 'required',
            'autor'            => 'required',
            'editora'          => 'required',
            'tombo'            => 'required',
            /* 'tombo_antigo'     => 'required', */
            'cod_impressao'    => 'required',
            'ordem_relatorio'  => 'required',
            'tipo_tombamento'   => 'required',
            'tipo_material'    => 'required',
            'subcategoria'     => 'required',
            'capes'            => 'required',
            /* 'id_material'      => 'required', */
            /* 'id_sugestao'      => 'required', */
            /* 'UsuarioS'         => 'required', */
            /* 'UsuarioA'         => 'required', */
            /* 'link'             => 'required', */
            'edicao'           => 'required',
            'volume'           => 'required',
            /* 'parte'            => 'required', */
            /* 'fasciculo'        => 'required', */
            'local'            => 'required',
            'ano'              => 'required',
            /* 'colecao'          => 'required', */
            'isbn'             => 'required',
            'escala'           => 'required',
            'dpto'             => 'required',
            'pedido_por'       => 'required',
            'finalidade'       => 'required',
            'data_pedido'      => 'required',
            'prioridade'       => 'required',
            'status'           => 'required',
            'moeda'            => 'required',
            'preco'            => 'required',
            'procedencia'      => 'required',
            'observacao'       => 'required',
            'verba'            => 'required',
            'processo'         => 'required',
            'fornecedor'       => 'required',
            'nota_fiscal'      => 'required',
            /* 'pasta'            => 'required', */
            /* 'moeda_nf'         => 'required', */
            /* 'preco_nf'         => 'required', */
            'data_nf'          => 'required',
        ]);

        /* Alterar status */
        $tombamento->status = "Em tombamento";

        /*Salvar*/
        $tombamento->motivo = $request->motivo;
        $tombamento->tombo = $request->tombo;
        $tombamento->tombo_antigo = $request->tombo_antigo;
        $tombamento->cod_impressao = $request->cod_impressao;
        $tombamento->ordem_relatorio = $request->ordem_relatorio;
        $tombamento->tipo_tombamento = $request->tipo_tombamento;
        $tombamento->tipo_material = $request->tipo_material;
        $tombamento->subcategoria = $request->subcategoria;
        $tombamento->capes = $request->capes;
        /* $tombamento->id_material = $request->id_material; */
        /* $tombamento->id_sugestao = $request->id_sugestao; */
        $tombamento->UsuarioS = $request->UsuarioS;
        $tombamento->UsuarioA = $request->UsuarioA;
        $tombamento->titulo = $request->titulo;
        $tombamento->autor = $request->autor;
        $tombamento->link = $request->link;
        $tombamento->edicao = $request->edicao;
        $tombamento->volume = $request->volume;
        $tombamento->parte = $request->parte;
        $tombamento->fasciculo = $request->fasciculo;
        $tombamento->local = $request->local;
        $tombamento->editora = $request->editora;
        $tombamento->ano = $request->ano;
        $tombamento->colecao = $request->colecao;
        $tombamento->isbn = $request->isbn;
        $tombamento->escala = $request->escala;
        $tombamento->dpto = $request->dpto;
        $tombamento->pedido_por = $request->pedido_por;
        $tombamento->finalidade = $request->finalidade;

        $tombamento->data_pedido = $request->$data_pedido;        
        $tombamento->prioridade = $request->prioridade;
        $tombamento->status = $request->status;
        $tombamento->moeda = $request->moeda;
        $tombamento->preco = $request->preco;
        $tombamento->procedencia = $request->procedencia;
        $tombamento->observacao = $request->observacao;
        $tombamento->verba = $request->verba;
        $tombamento->processo = $request->processo;
        $tombamento->fornecedor = $request->fornecedor;
        $tombamento->nota_fiscal = $request->nota_fiscal;
        /* $tombamento->pasta = $request->pasta; */
        /* $tombamento->moeda_nf = $request->moeda_nf; */
        /* $tombamento->preco_nf = $request->preco_nf; */

        $tombamento->data_nf = $request->$data_nf;
        
        $tombamento->save();

        $request->session()->flash('alert-info',"Aquisição processada, novo status: {$tombamento->status}");
        return redirect('/');
    }


    //Processar Aquisição
    public function lista_aquisicao()
    {
        $this->authorize('sai');
        $itens = item::where('status',"Em processo de aquisição")->get();
        return view('itens/lista_aquisicao',compact('itens'));
        //$users = User::select ();
        //return view('itens/lista_aquisicao',compact('users'));
    }

    public function consulta()
    {
        $itens = item::all();
        return view('itens/consulta',compact('itens'));
    }

    public function insercao_direta(item $tombamento)
    {
        return view('itens/insercao_direta');
    }

    public function store_insercao_direta(Request $request, item $tombamento)
    {
        
    }
}
