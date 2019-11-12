<?php

namespace App\Http\Controllers;

use App\Suggestion;
use App\Area;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

    /* Etapa 1 - Sugestão */
    public function index()
    {
        // select * from suggestion where status="Sugestão"
        $suggestions = Suggestion::where('status',"Sugestão")->get();
        return view('suggestions/index',compact('suggestions'));
    }

    public function create()
    {
        return view('suggestions/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'  => 'required',
            'autor'   => 'required',
            'editora' => 'required',
        ]);

        /* pegar itens que estão chegando e salvar no banco de dados */
        $suggestion = new Suggestion;
        $suggestion->titulo = $request->titulo;
        $suggestion->autor = $request->autor;
        $suggestion->editora = $request->editora;

        $suggestion->status = "Sugestão";
        $suggestion->save();

        $request->session()->flash('alert-info', 'Sugestão enviada com sucesso');

        return redirect('/');
    }


    /* Etapa 2 - Processar Sugestão */
    public function processar_sugestao(Suggestion $suggestion)
    {
        return view('suggestions/processar_sugestao',compact('suggestion'));
    }

    public function store_processar_sugestao(Request $request, Suggestion $suggestion)
    {
        
        if($request->status == 'Negado') {
            $request->validate([
                'motivo'  => 'required',
            ]);
            $suggestion->motivo = $request->motivo;
        }
        /* Alterar status */
        $suggestion->status = $request->status;
        $suggestion->save();

        $request->session()->flash('alert-info',"Sugestão processada, novo status: {$suggestion->status}");

        return redirect('/suggestions');        
    }

    /* Etapa 3 - Processar aquisição */
    public function processar_aquisicao(Suggestion $acquisition)
    {
        $areas = Area::all();
        return view('suggestions/processar_aquisicao',compact('acquisition','areas'));
    }

    public function store_processar_aquisicao(Request $request, Suggestion $acquisition)
    {
        /* Alterar status */
        $acquisition->status = "Em tombamento";

        /*Salvar*/
        $acquisition->motivo = $request->motivo;
        $acquisition->tombo = $request->tombo;
        $acquisition->tombo_antigo = $request->tombo_antigo;
        $acquisition->cod_impressao = $request->cod_impressao;
        $acquisition->ordem_relatorio = $request->ordem_relatorio;
        $acquisition->tipo_aquisicao = $request->tipo_aquisicao;
        $acquisition->tipo_material = $request->tipo_material;
        $acquisition->subcategoria = $request->subcategoria;
        $acquisition->capes = $request->capes;
        $acquisition->id_material = $request->id_material;
        $acquisition->id_sugestao = $request->id_sugestao;
        $acquisition->UsuarioS = $request->UsuarioS;
        $acquisition->UsuarioA = $request->UsuarioA;
        $acquisition->titulo = $request->titulo;
        $acquisition->autor = $request->autor;
        $acquisition->link = $request->link;
        $acquisition->edicao = $request->edicao;
        $acquisition->volume = $request->volume;
        $acquisition->parte = $request->parte;
        $acquisition->fasciculo = $request->fasciculo;
        $acquisition->local = $request->local;
        $acquisition->editora = $request->editora;
        $acquisition->ano = $request->ano;
        $acquisition->colecao = $request->colecao;
        $acquisition->isbn = $request->isbn;
        $acquisition->escala = $request->escala;
        $acquisition->dpto = $request->dpto;
        $acquisition->pedido_por = $request->pedido_por;
        $acquisition->finalidade = $request->finalidade;
        $acquisition->data_pedido = $request->data_pedido;
        $acquisition->prioridade = $request->prioridade;
        $acquisition->status = $request->status;
        $acquisition->moeda = $request->moeda;
        $acquisition->preco = $request->preco;
        $acquisition->procedencia = $request->procedencia;
        $acquisition->observacao = $request->observacao;
        $acquisition->verba = $request->verba;
        $acquisition->processo = $request->processo;
        $acquisition->fornecedor = $request->fornecedor;
        $acquisition->nota_fiscal = $request->nota_fiscal;
        $acquisition->pasta = $request->pasta;
        $acquisition->moeda_nf = $request->moeda_nf;
        $acquisition->preco_nf = $request->preco_nf;
        $acquisition->data_nf = $request->data_nf;

        $acquisition->save();
        return redirect('/');        
    }


    //Processar Aquisição
    public function lista_aquisicao()
    {
        $suggestions = Suggestion::where('status',"Em processo de aquisição")->get();
        return view('suggestions/lista_aquisicao',compact('suggestions'));
    }


}
