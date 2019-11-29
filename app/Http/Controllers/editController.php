<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editController extends Controller
{
    public function index()
    {
        $this->authorize('logado');
    	return view('index');
    }

   // Edição
   public function editEdit(item $item)
   {
        $this->authorize('logado');
        $areas = Area::all();
        return view('itens/edit',compact('item','areas'));
   }

   public function updateEdit(Request $request, item $item)
   {
        $this->authorize('logado');
        $request->validate([
                'tombo'            => 'required',
                'titulo'           => 'required',
                'autor'            => 'required',
                'cod_impressao'    => 'required',
                'tipo_tombamento'  => 'required',
                'tipo_material'    => 'required',
                'editora'          => 'required',
                'verba'            => 'required',
        ]);


        /* pegar itens que estão chegando e salvar no banco de dados */
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
        // formatar: $item->data_nf = $request->$data_nf;
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


        $item->status = "Editado pelo usuário";
        $item->save();

        $request->session()->flash('alert-info', 'Dados editados com sucesso');
        return redirect('/');
       
    }
}
