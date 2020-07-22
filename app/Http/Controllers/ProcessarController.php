<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;
use App\Http\Requests\ItemRequest;

class ProcessarController extends Controller
{
        public function processarSugestao(Request $request, Item $item){
        if ($request->processar_sugestao == 'Em Cotação'){
            $item->status = 'Em Cotação';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }

        if ($request->processar_sugestao == 'Em Tombamento'){
            $areas = Area::all();
            $item->status = 'Em Tombamento';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}"); 
        }

        if ($request->processar_sugestao == 'Negado'){
            
            $request->validate([
                'motivo' => 'required'
            ]);

            $item->status = 'Negado';
            $item->motivo = $request->motivo;
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para {$item->status}");
        } 
        return redirect("/item/{$item->id}");      
    }

    public function processarCotacao(Request $request, Item $item){
        if($request->processar_cotacao == 'Em Licitação'){
            $item->status = 'Em Licitação';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");  
        }

        if ($request->processar_cotacao == 'Negado'){
            
            $request->validate([
                'motivo' => 'required'
            ]);

            $item->status = 'Negado';
            $item->motivo = $request->motivo;
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }

    public function processarLicitacao(Request $request, Item $item){
;
        if($request->processar_licitacao == 'Em Tombamento'){
            $item->status = 'Em Tombamento';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }

    public function processarTombamento(ItemRequest $request, Item $item){

        if($request->processar_tombamento == 'tombar'){

            $item->status = 'Tombado';

            //numero de tombo será gerado automaticamente
            if(empty($item->tombo)) {
                $item->tombo = Item::max('tombo') + 1;
            }  

            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status} - Tombo gerado: {$item->tombo}");
            
        }

        if($request->processar_tombamento == 'salvar'){
            $validated = $request->validated();
            $item->update($validated);
            $request->session()->flash('alert-info', "Dados forma salvos");
        }

        return redirect("/item/{$item->id}");
    }
    //quando for tombado
    public function processarProcessamento(Request $request, Item $item){
        if($request->processar_processamento == 'Em Processamento Técnico'){
            $item->status = 'Em Processamento Técnico';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }
    //quando estiver em processamento técnico
    public function processarProcessado(Request $request, Item $item){
        if($request->processar_processado == 'Processado'){
            $item->status = 'Processado';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        if($request->processar_processado == 'Em Tombamento'){
            $item->status = 'Em Tombamento';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para: {$item->status}");
        }
        return redirect("/item/{$item->id}");
    }
}
