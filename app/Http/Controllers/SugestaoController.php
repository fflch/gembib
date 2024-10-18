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
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;


class SugestaoController extends Controller
{
    private $area = Area::area;
    private $campos = Item::campos_sugestao;

    public function sugestaoForm(){
        $this->authorize('logado');
        return view('sugestao/form', [
            'area'  => $this->area,
        ]);
    }

    private function search(){
        $request = request();
        $itens = Item::select('id','autor','tombo','titulo','volume','parte','preco','editora','status','ano','procedencia','sugerido_por','is_active','data_processado','data_sugestao')->where('status', 'Sugestão');

        if($request->has('campos') && $request->has('search')) {
            $campos = $this->campos;
            unset($campos['todos_campos']);
            foreach($request->campos as $key => $value) {
                $itens->when(!is_null($value) && !is_null($request->search[$key]),
                    function($query) use ($request, $campos, $key, $value) {
                        if($value == 'todos_campos'){
                            if(array_key_first($campos) == 'autor') {
                                array_reverse($campos);
                            }
                            $first_key = array_key_first($campos);
                            array_shift($campos);
                            $query->where(function($q) use ($request, $campos, $first_key, $key, $value) {
                                $q->where($first_key, 'LIKE', '%' . $request->search[$key] . '%');
                                foreach($campos as $chave => $campo) {
                                    $q->orWhere($chave, 'LIKE', '%' . $request->search[$key] . '%');
                                    if($chave == 'autor' && Str::contains($request->search[$key], ' ')) {
                                        $search_reverse = Util::reverse_string($request->search[$key]);
                                        $q->orWhere($chave, 'LIKE', '%' . $search_reverse . '%');
                                    }
                                }
                            });
                        }
                        elseif($value == 'autor') {
                            $query->where($value, 'LIKE', '%' . $request->search[$key] . '%');
                            if(Str::contains($request->search[$key], ' ')) {
                                $search_reverse = Util::reverse_string($request->search[$key]);
                                $query->orWhere($value, 'LIKE', '%' . $search_reverse . '%');
                            }
                        }
                        else {
                            $query->where($value,'LIKE', '%'. $request->search[$key] .'%');
                        }
                    }
                );
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
        ]);
    }
//métodos adicionados, pois o export pra pdf e excel não estavam funcionando
    private function reportItens() {
        $query = $this->search();
        $itens = $query->get();
        $total = $query->sum('preco');

        $pdf = PDF::loadView('pdfs.relatorio', compact('itens','total'));
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        //A função abaixo serve para colocar o marcador de página na relatorioSTL
        $canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->download('relatorioSAI.pdf',[
            'itens' => $itens,
        ]);
    }

    public function excel(){
        $query = $this->search();
        $q = clone $query;
        if($q->count() > 10000){
            request()->session()->flash('alert-danger',"Não foi possível baixar o arquivo,
            limite de 10000 registros excedido");
            return redirect('/sai');
        }
        $export = new FastExcel($query->get());
        return $export->download(date("YmdHi").'gembib.xlsx');
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
