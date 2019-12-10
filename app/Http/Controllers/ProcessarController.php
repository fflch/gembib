<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProcessarController extends Controller
{
    private $status = [
        "Sugestão",
        "Negado",
        "Em cotação",
        "Em licitação",
        "Tombado",
    ];
    
    public function processarIndex()
    {
        $this->authorize('stl');
        $itens = item::all();
        
        return view('processar/index',compact('itens'));
    }

    public function processarForm(Item $item)
    {
        $this->authorize('stl');
        $status = $this->status;
        $areas = Area::all();
        return view('processar/form',compact('item','status','areas'));
    }

    public function processar(Request $request)
    {   
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

        if($request->status == 'Negado') {
            $request->validate([
                'motivo'  => 'required',
            ]);
            $item->motivo = $request->motivo;
        }

        $item->save();
        $request->session()->flash('alert-info', "Sugestão processada com sucesso.");

        return redirect('/');
    }
}
