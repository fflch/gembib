<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ItemRequest;

class ProcessarController extends Controller
{
        public function processarSugestao(Request $request, Item $item){
        if ($request->processar_sugestao == 'Negado'){
        
            $request->validate([
                'motivo' => 'required'
            ]);
            $item->motivo = $request->motivo;
        } 
            $item->status = $request->processar_sugestao;
            $item->observacao = $request->observacao;
            $item->alterado_por = Auth::user()->codpes;
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
    
            return redirect("/item/{$item->id}");
    }

    public function processarCotacao(Request $request, Item $item){
        if ($request->processar_cotacao == 'Negado'){
            
            $request->validate([
                'motivo' => 'required'
            ]);
            $item->motivo = $request->motivo;
        }
            $item->status = $request->processar_cotacao;
            $item->observacao = $request->observacao;
            $item->alterado_por = Auth::user()->codpes;
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        
        return redirect("/item/{$item->id}");
    }

    public function processarLicitacao(Request $request, Item $item){
;
        if($request->processar_licitacao == 'Em Tombamento'){
            $item->status = 'Em Tombamento';
            $item->alterado_por = Auth::user()->codpes;
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }

    public function processarTombamento(ItemRequest $request, Item $item){

        if($request->processar_tombamento == 'tombar'){
            $validated = $request->validated();
            $validated['status'] = 'Tombado';
            //numero de tombo será gerado automaticamente
            if(empty($item->tombo)) {
                $validated['tombo'] = Item::max('tombo') + 1;
            } 
            $item->alterado_por = Auth::user()->codpes;
            $item->update($validated);
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status} - Tombo gerado: {$item->tombo}");
        }

        if($request->processar_tombamento == 'salvar'){
            $validated = $request->validated();
            $item->alterado_por = Auth::user()->codpes;
            $item->update($validated);
            $request->session()->flash('alert-info', "Dados foram salvos");
        }
        //Quando já tiver tombo (Devolver para Processamento)
        if($request->processar_tombamento == 'Em Processamento Técnico'){
            $item->status = 'Em Processamento Técnico';
            $validated = $request->validated();
            $item->alterado_por = Auth::user()->codpes;
            $item->update($validated);
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }

        return redirect("/item/{$item->id}");
    }

    //quando for tombado - entra em trânsito até ser aceito pelo processamento técnico
    public function enviarProcessamento(Request $request, Item $item){
        if($request->enviar_processamento == 'Em Trânsito'){
            $item->status = 'Em Trânsito';
            $item->observacao = $request->observacao;
            $item->alterado_por = Auth::user()->codpes;
            $item->data_processamento = Carbon::now();
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }

    //quando for mandado para o processamento técnico
    public function processarProcessamento(Request $request, Item $item){
        if($request->processar_processamento == 'Em Processamento Técnico'){
            $item->status = 'Em Processamento Técnico';
            $item->observacao = $request->observacao;
            $item->alterado_por = Auth::user()->codpes;
            $item->data_processamento = Carbon::now();
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }

    //quando for processado
    public function processarProcessado(Request $request, Item $item){
            $item->status = $request->processar_processado;
            $item->observacao = $request->observacao;
            $item->alterado_por = Auth::user()->codpes;
            $item->data_processado = Carbon::now();
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        return redirect("/item/{$item->id}");
    }
}