<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class StlController extends Controller
{
    private $campos = Item::campos;
    private $status = Item::status;
    private $procedencia = Item::procedencia;
    private $tipo_material = Item::tipo_material;
    private $tipo_aquisicao = Item::tipo_aquisicao;
        
    private function search(){
        $request = request();
        $itens = Item::orderBy('autor', 'asc');
        $this->authorize('admin');


        if(isset($request->search[0]) && isset($request->campos[0])) {
            if($request->campos[0] == 'todos_campos'){
                $itens->where('cod_impressao','LIKE', '%'.$request->search[0].'%')
                    ->orwhere('autor','LIKE', '%'.$request->search[0].'%')
                    ->orwhere('tombo','LIKE', '%'.$request->search[0].'%')
                    ->orwhere('observacao','LIKE', '%'.$request->search[0].'%')
                    ->orwhere('verba','LIKE', '%'.$request->search[0].'%')
                    ->orwhere('processo','LIKE', '%'.$request->search[0].'%')
                    ->orwhere('titulo','LIKE', '%'.$request->search[0].'%');
            }
            else{
                $itens->where($request->campos[0],'LIKE', '%'.$request->search[0].'%');
            }
            
        }
        if(isset($request->search[1]) && isset($request->campos[1])) {
            if($request->campos[1] == 'todos_campos'){
                $itens->where('cod_impressao','LIKE', '%'.$request->search[1].'%')
                    ->orwhere('autor','LIKE', '%'.$request->search[1].'%')
                    ->orwhere('tombo','LIKE', '%'.$request->search[1].'%')
                    ->orwhere('observacao','LIKE', '%'.$request->search[1].'%')
                    ->orwhere('verba','LIKE', '%'.$request->search[1].'%')
                    ->orwhere('processo','LIKE', '%'.$request->search[1].'%')
                    ->orwhere('titulo','LIKE', '%'.$request->search[1].'%');
            }
            else{
                $itens->where($request->campos[1],'LIKE', '%'.$request->search[1].'%');
            }   
        }
        if(isset($request->search[2]) && isset($request->campos[2])) {
            if($request->campos[2] == 'todos_campos'){
                $itens->where('cod_impressao','LIKE', '%'.$request->search[2].'%')
                    ->orwhere('autor','LIKE', '%'.$request->search[2].'%')
                    ->orwhere('tombo','LIKE', '%'.$request->search[2].'%')
                    ->orwhere('observacao','LIKE', '%'.$request->search[2].'%')
                    ->orwhere('verba','LIKE', '%'.$request->search[2].'%')
                    ->orwhere('processo','LIKE', '%'.$request->search[2].'%')
                    ->orwhere('titulo','LIKE', '%'.$request->search[2].'%');
            }
            else{
                $itens->where($request->campos[2],'LIKE', '%'.$request->search[2].'%');
            }
        }
        

        if (!empty($request->status)) {
            
            $itens->where(function ($p) use (&$request) {
                $p->where('status','=',$request->status);
            });
        }
        
        if (!empty($request->procedencia)) {
            $itens->where(function ($s) use (&$request) {
                $s->where('procedencia','=',$request->procedencia)
                  ->orwhere('procedencia','=',$request->procedencia);
            });
        }
        
        if (!empty($request->tipo_material)) {
            $itens->where(function ($t) use (&$request) {
                $t->where('tipo_material','=',$request->tipo_material)
                  ->orwhere('tipo_material','=',$request->tipo_material);
            });
        }
        
        if (!empty($request->tipo_aquisicao)) {
            $itens->where(function ($a) use (&$request) {
                $a->where('tipo_aquisicao','=',$request->tipo_aquisicao)
                  ->orwhere('tipo_aquisicao','=',$request->tipo_aquisicao);
            });
        }
        if (!empty($request->data_sugestao_inicio) && !empty($request->data_sugestao_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_sugestao_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_sugestao_fim);
            $itens->whereBetween('data_sugestao', [$from, $to]);
            $itens->whereNotNull('data_sugestao');
        }

        if (!empty($request->data_processamento_inicio) && !empty($request->data_processamento_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_processamento_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_processamento_fim);
            $itens->whereBetween('data_processamento', [$from, $to]);
            $itens->whereNotNull('data_processamento');
        }

        if (!empty($request->data_tombamento_inicio) && !empty($request->data_tombamento_fim)) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_tombamento_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->data_tombamento_fim);
            $itens->whereBetween('data_tombamento', [$from, $to]);
            $itens->whereNotNull('data_tombamento');
        }

        return $itens;
    }
    public function index(Request $request){
        $this->authorize('admin');
        $itens = $this->search();
        $query = $itens->paginate(15);
        
        return view('stl.index',[
            'itens'         => $itens,
            'campos'        => $this->campos,
            'query'         => $query,
            'procedencia'   => $this->procedencia,
            'tipo_material' => $this->tipo_material,
            'tipo_aquisicao'=> $this->tipo_aquisicao,
            'status'        => $this->status
        ]);
    }
}
