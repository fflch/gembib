<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Area;
use Carbon\Carbon;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\Util;
use Mail;
use App\Mail\email_sugestao;
use DB;
use PDF;


class SugestaoController extends Controller
{    
    private $area = Area::area;
    private $campos = Item::campos;
    private $status = Item::status;
    private $procedencia = Item::procedencia;
    private $tipo_material = Item::tipo_material;
    private $tipo_aquisicao = Item::tipo_aquisicao;

    public function sugestaoForm(){
        $this->authorize('logado');
        return view('sugestao/form', [
            'area'  => $this->area,
        ]);
    }

    private function search(){
        $request = request();
        $itens = Item::select('id','autor','tombo','titulo','editora','status','ano','procedencia','sugerido_por','is_active','data_processado','data_sugestao')->where('status','=','sugestão');

        if($request->has('campos')) {
            $campos = Item::campos;
            unset($campos['todos_campos']);
            foreach($request->campos as $key => $value) {
                $itens->when(!is_null($value) && !is_null($request->search[$key]),
                    function($query) use ($request, $campos, $key, $value) {
                        $string = explode(' ', $request->search[$key]);
                        $string_reverse = array_reverse($string);
                        $string = implode('%',$string);
                        $string_reverse = implode('%', $string_reverse);
                        
                        if($value == 'todos_campos'){
                            foreach($campos as $chave => $campo) {
                                if($chave == 'titulo'){
                                    $query->where($chave, 'LIKE', '%' . $string . '%');
                                    $query->orWhere($chave, 'LIKE', '%' . $string_reverse . '%');
                                }
                                else{
                                    $query->orWhere($chave, 'LIKE', '%' . $string . '%');
                                    $query->orWhere($chave, 'LIKE', '%' . $string_reverse . '%');
                                }
                            }
                        }
                        else {
                            $query->where($value,'LIKE', '%'.$string.'%');
                            $query->orWhere($value,'LIKE', '%' . $string_reverse . '%');
                        }
                    }
                )->where('status','=','sugestão');
            }
        }
        $itens->when(($request->data_sugestao_inicio) && ($request->data_sugestao_fim), function($query) use ($request) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_sugestao_inicio)->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', $request->data_sugestao_fim)->format('Y-m-d');
            $query->whereBetween('data_sugestao', [$from, $to]);
            $query->whereNotNull('data_sugestao');
        });
        return $itens->toBase();
    }
    
    public function index(Request $request){
        
        $this->authorize('ambos');

        if($request->relatorio == 'relatorio'){
            return $this->reportItens();
        }

        if($request->excel == 'excel'){
            return $this->excel();
        }

        $query = $this->search()->paginate(15);

        return view('sugestao.index',[
            'campos'        => $this->campos,
            'query'         => $query,
            'quantidades'   => Util::quantidades($request),
            'procedencia'   => $this->procedencia,
            'tipo_material' => $this->tipo_material,
            'tipo_aquisicao'=> $this->tipo_aquisicao,
            'status'        => $this->status
        ]);
    }

    public function sugestao(Request $request)
    {
        $this->authorize('logado');
        $request->validate([
            'titulo'  => 'required',
            'autor'   => 'required',
            'editora' => 'required',
            'ano'     => 'nullable|integer|digits:4|',
        ]);

        $item = new Item;
        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->isbn = $request->isbn;
        $item->volume = $request->volume;
        $item->tradutor = $request->tradutor;
        $item->local = $request->local;
        $item->preco_editora = $request->preco_editora;
        $item->area = $request->area;
        $item->informacoes = $request->informacoes;
        $item->sugerido_por = Auth::user()->codpes;
        $item->alterado_por = Auth::user()->codpes;
        $item->data_sugestao = Carbon::now();

        $item->status = "Sugestão";
        $item->save();
        Mail::queue(new email_sugestao($item));

        $request->session()->flash('alert-info', 'Sugestão enviada com sucesso');

        return redirect("/item/{$item->id}");
    }
}
