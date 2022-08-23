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

        if($request->has('campos')) {
            $campos = Item::campos;
            unset($campos['todos_campos']);
            foreach($request->campos as $key => $value) {
                $itens->when(!is_null($value) && !is_null($request->search[$key]),
                    function($query) use ($request, $campos, $key, $value) {
                        if($value == 'todos_campos'){
                            foreach($campos as $chave => $campo) {
                                $query->orWhere($chave, 'LIKE', '%' . $request->search[$key] . '%');
                            }
                        }
                        else {
                            $query->where($value,'LIKE', '%'.$request->search[$key].'%');
                        }
                    }
                );
            }
        }

        $itens->when($request->status, function($query) use ($request) {
            $query->where('status', '=', $request->status);
        });

        $itens->when($request->procedencia, function($query) use ($request) {
            $query->where('procedencia', '=', $request->procedencia);
        });

        $itens->when($request->tipo_material, function($query) use ($request) {
            $query->where('tipo_material', '=', $request->tipo_material);
        });

        $itens->when($request->tipo_aquisicao, function($query) use ($request) {
            $query->where('tipo_aquisicao', '=', $request->tipo_aquisicao);
        });

        $itens->when($request->data_sugestao_inicio && $request->data_sugestao_fim,
            function($query) use ($request) {
                $query->whereBetween('data_sugestao', [
                    $request->data_sugestao_inicio,
                    $request->data_sugestao_fim
                ]);
        });

        $itens->when($request->data_processamento_inicio && $request->data_processamento_fim,
            function($query) use ($request) {
                $query->whereBetween('data_processamento', [
                    $request->data_processamento_inicio,
                    $request->data_processamento_fim
                ]);
        });

        $itens->when($request->data_tombamento_inicio && $request->data_tombamento_fim,
            function($query) use ($request) {
                $query->whereBetween('data_tombamento', [
                    $request->data_tombamento_inicio,
                    $request->data_tombamento_fim
                ]);
        });

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
