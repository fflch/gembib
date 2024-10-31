<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Models\Item;

class EtiquetaController extends Controller
{
    public function form(Item $itens){
        $this->authorize('logado');
        return view('etiquetas', ['itens' => $itens]);
    }

    public function impressao(Request $request, $codimpressao){
        $this->authorize('logado');
        if($codimpressao){
            $itens = Item::where('cod_impressao', [$codimpressao])->
                           whereNotNull('tombo')->get();
            if($itens->isNotEmpty()) {
                $this->etiquetasTombo($itens);
            }
        }

    }
    public function show(Request $request){

        $this->authorize('logado');
        if(isset($request->cod_impressao)){
            $request->validate([
                'cod_impressao'  => 'required'
            ]);
            $totalItens = Item::where('cod_impressao', [$request->cod_impressao])->
            whereNotNull('tombo')->count();
            if($totalItens > 330){ //mais que 10 páginas
                $intervalos = "";
                $totalPages = (int)ceil($totalItens/33);
                for($i = 1; $i<= (int)ceil($totalItens/33); $i+=10){
                    $limit = $i+9 > (int)ceil($totalItens/33) ? (int)ceil($totalItens/33) : $i+9;
                    $intervalos .= "$i-".$limit." ";

                }
                if(!isset($request->pag_inicio) || !isset($request->pag_fim) || (((int)$request->pag_fim - (int)$request->pag_inicio) >10)){
                    request()->session()->flash('alert-danger',"Esta etiqueta possui $totalItens tombos, totalizando ".(int)ceil($totalItens/33)." páginas a imprimir. Por favor, indique um intervalo de no MÁXIMO 10 páginas para gerar.\n
                    Por exemplo, para imprimir todos os tombos é necessário ".(int)ceil($totalItens/330)." etapas: $intervalos ");
                    $cod_impressao = $request->cod_impressao;
                    return view('etiquetas', compact('intervalos', 'totalPages', 'cod_impressao'));
                }else{
                    $itens = Item::where('cod_impressao', [$request->cod_impressao])->
                    whereNotNull('tombo')->skip(((int)$request->pag_inicio - 1)*33)->take((((int)$request->pag_fim - (int)$request->pag_inicio)+1)*33)->get();
                }

            }else{
                $itens = Item::where('cod_impressao', [$request->cod_impressao])->
                whereNotNull('tombo')->get();
            }
        }
        else{
            $request->validate([
                'tombo_inicio'  => 'required|integer',
                'tombo_fim'   => 'required|integer|gte:tombo_inicio',
                'margem' => 'nullable|integer',
            ]);
            $itens = Item::whereBetween('tombo', [$request->tombo_inicio, $request->tombo_fim])->get();
        }

        if($itens->isNotEmpty()) {
            if($request->etiqueta == 'tombo')
                $this->etiquetasTombo($itens);
            else {
                $itens = $itens->where('no_cutter','!=', '');
                if($itens->isEmpty()){
                    return redirect('/etiquetas')->with('alert-danger','Nenhum item com lombada gerada');
                    }
                    $this->etiquetasLombada($itens);
                }
            }
        else {
            return redirect()->back()->with('alert-danger','Registro não encontrado!');
        }

    }

    private function etiquetasTombo($itens){
        $pimaco = new Pimaco(request()->etiquetaPimaco);

        foreach($itens as $item){
            $tag = new Tag();
            $tag->setBorder(0);
            $tag->setSize(2);

            $barcode = new Barcode((string)$item->tombo, null);
            $barcode->setAlign('right');
            $barcode->setWidth(1);

            $limiteCaracteres = 10;
            $margem = request()->margem;
            $codigo = $barcode->render();
            $tag->p(view('pdfs.etiquetas', compact ( 'codigo','limiteCaracteres','item', 'margem')));
            $pimaco->addTag($tag);



        }
        $pimaco->output();

    }

    private function etiquetasLombada($itens){

        $pimaco = new Pimaco(request()->etiquetaPimaco);

        foreach($itens as $item){
            $tag = new Tag();
            $tag->setBorder(0);
            $tag->setSize(2);
            $margem = request()->margem;
            $tag->p(view('pdfs.etiquetas_lombada', compact ('item', 'margem')));
            $pimaco->addTag($tag);
        }
        $pimaco->output();
    }
}

