<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Models\Item;

class EtiquetaController extends Controller
{
    public function form(){
        $this->authorize('logado');
        return view('etiquetas');
    }

    public function impressao($codimpressao){
        $this->authorize('logado');
        if($codimpressao){
            $itens = Item::where('cod_impressao', [$codimpressao])->
                           whereNotNull('tombo')->get();
            if($itens->isNotEmpty()) {
                $this->printerPimaco($itens);
            }
        }

    }
    public function show(Request $request){
        $this->authorize('logado');
        if(isset($request->cod_impressao)){
            $request->validate([
                'cod_impressao'  => 'required'
            ]);
            $itens = Item::where('cod_impressao', [$request->cod_impressao])->
                           whereNotNull('tombo')->get();
        }
        else{
            $request->validate([
                'tombo_inicio'  => 'required|integer',
                'tombo_fim'   => 'required|integer|gte:tombo_inicio',
            ]);
            $itens = Item::whereBetween('tombo', [$request->tombo_inicio, $request->tombo_fim])->get();
        }

        if($itens->isNotEmpty()) {
            $this->printerPimaco($itens);
        }
        else {
            return redirect()->back()->with('alert-danger','Registro não encontrado!');
        }

    }

    private function printerPimaco($itens){

        $pimaco = new Pimaco('A4256');

        foreach($itens as $item){
            $tag = new Tag();
            $tag->setBorder(0);
            $tag->setSize(2);

            $barcode = new Barcode((string)$item->tombo, null);
            $barcode->setAlign('right');
            $barcode->setWidth(1);

            $limiteCaracteres = 10;

            $codigo = $barcode->render();
            $tag->p(view('pdfs.etiquetas', compact ('itens', 'codigo','limiteCaracteres','item')));
            $pimaco->addTag($tag);
        }

        $pimaco->output();
    }
}

