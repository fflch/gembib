<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Item;

class EtiquetaController extends Controller
{
    public function form(){
        $this->authorize('logado');
        return view('etiquetas');
    }

    public function show(Request $request){
        if(isset($request->cod_impressao)){
            $request->validate([
                'cod_impressao'  => 'required'
            ]);
        $itens = Item::where('cod_impressao', [$request->cod_impressao])->get();

        }else{
            $request->validate([
            'tombo_inicio'  => 'required|integer',
            'tombo_fim'   => 'required|integer|gte:tombo_inicio',
        ]);

        $itens = Item::whereBetween('tombo', [$request->tombo_inicio, $request->tombo_fim])->get();

        }

        $pimaco = new Pimaco('6180');

        foreach($itens as $item){
            $tag = new Tag();
            $tag->setBorder(0);
            $tag->setSize(2);

            $barcode = new Barcode((string)$item->tombo, null);
            $barcode->setAlign('right');
            $barcode->setWidth(1);

            $tag->p("
<table style='width:100%'>
  <tr>
    <td style='width:60%'>" .
        "<span style='font-size: 08px'><b>Tombo: </b>" . $item->tombo . "<br>" .
        "<b>Verba: </b>" . $item->verba . "<br>" .
        "<b>Aquisição: </b>" . $item->tipo_aquisicao . "<br>" .
        "<b>Processo: </b>" . $item->processo . "<br>" .
        "<b>NF: </b>" . $item->nota_fiscal . "<br>" .
        "<b>Preço: </b> R$ " . str_replace('.',',',$item->preco) . "<br>" .
        "<b>Fornecedor: </b>" . $item->fornecedor . "<br>" 
    ."</span></td>
    <td style='text-align:right;'>" . $barcode->render() ."<br>SBD/FFLCH" ."</td>
  </tr>
</table>
    ");
            $pimaco->addTag($tag);
        }

        $pimaco->output();
    }
}
