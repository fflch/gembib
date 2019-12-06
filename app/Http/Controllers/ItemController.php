<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ItemController extends Controller
{
    private $status = [
        "Sugestão",
        "Negado",
        "Em cotação",
        "Em licitação",
        "Tombado",
    ];

    public function insercaoForm()
    {
        $this->authorize('logado');
        return view('item/insercao');
    }

    public function show(Request $request, Item $item)
    {
        $this->authorize('logado');
        return view('item/show', compact('item'));
    }

    public function insercao(Request $request)
    {
        $this->authorize('logado');
        $request->validate([
            'tombo'            => 'required',
            'titulo'           => 'required',
            'autor'            => 'required',
            'cod_impressao'    => 'required',
            'tipo_tombamento'   => 'required',
            'tipo_material'    => 'required',
            'editora'          => 'required',
        ]);

        $item = new Item;
        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->sugerido_por_id = Auth::id();
        $item->tombo = $request->tombo;
        $item->tombo_antigo = $request->tombo_antigo;
        $item->tipo_tombamento = $request->tipo_tombamento;
        $item->tipo_material = $request->tipo_material;
        $item->parte = $request->parte;
        $item->volume = $request->volume;
        $item->fasciculo = $request->fasciculo;
        $item->local = $request->local;
        $item->colecao = $request->colecao;
        $item->isbn = $request->isbn;
        $item->link = $request->link;
        $item->edicao = $request->edicao;
        $item->dpto = $request->dpto;
        $item->prioridade = $request->prioridade;
        $item->procedencia = $request->procedencia;
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

        /*Outra prioridade*/
        $outraPrioridade = $request->outraPrioridade;
        if($request->prioridade == 'Outra'){
            $item->prioridade = $outraPrioridade;
        }
        /*fim outra prioridade*/

        /*Outra verba*/
        $outraVerba = $request->outraVerba;
        if($request->verba == 'Outras'){
            $item->verba = $outraVerba;
        }
        /*fim outra verba*/

        //Salvar valor escolhido em Subcategoria - N ESTÁ FUNCIONANDO
        $subcategoria = $request->subcategoria;//name
        if($request->tipo_material == 'Teses'){
            $item->subcategoria = $subcategoria;
        }
        //Salvar valor digitado em Tipo de Material - FUNCIONANDO
        $outroMaterial = $request->outromaterial;        
        if($request->tipo_material == 'Outros'){
            $item->tipo_material = $outroMaterial;
        }
        //Salvar valor digitado em Escala - FUNCIONANDO
        $valorescala = $request->escala;
        if($request->tipo_material == 'Mapas'){
            $item->escala = $valorescala;
        }

        $item->status = "Tombado";
        $item->save();

        $data = Carbon::parse($item->data_tombamento);
        $dataformatada = $data->format('d/m/Y');

        $request->session()->flash('alert-info', "Inserção direta enviada com sucesso em {$dataformatada}. Novo status: {$item->status}");

        return redirect('/');
        
    }

}
