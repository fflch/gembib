<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;
use App\Item;
use Dompdf\Dompdf;

class RelatorioController extends Controller
{
    public function form(){
        $this->authorize('sai');
        return view('relatorios');
    }

    public function show(Request $request){
    	$this->authorize('sai');
    	$request->validate([
                'cod_impressao'  => 'required',
                'titulo'  => 'required'
            ]);
    	
        $itens = Item::where('cod_impressao', $request->cod_impressao)->get();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $base = url('/');
        $imagem = './images/logo.png';
        
        $html = "
<table style='width:100%'>
    <tr>
        <td style='width:20%' style='text-align:left;'>
            <img src='{$imagem}' width='230px'/>
        </td>
        <td style='width:80%'; style='text-align:center;'>
            <p align='center'><b>SERVIÇO DE BIBLIOTECA E DOCUMENTAÇÃO</b><br>
            FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS - USP<br>
            Av.: Prof. Lineu Prestes - travessa 12. n° 350 CEP: 05508-900 - Cidade Universitária - São Paulo - SP / Brasil<br>
            Serviço de Aquisição e Intercâmbio (11)3091-4502 - saifflch@usp.br</p>
        </td>
    </tr>
</table>
";
    $html .= "<div><h3><center>{$request->titulo}</center></h3></div>";

    $html .= "
<table style='width:100%'>
  <thead>
    <tr>
      <th>Tombo:</th>
      <th>Autor:</th>
      <th>Título:</th>
      <th>Volume:</th>
      <th>Parte:</th>
      <th>Moeda:</th>
      <th>Preço:</th>
    </tr>
  </thead>
  <tbody>";

  	foreach($itens as $item) {
    $preco = str_replace('.',',', $item->preco);

    $html .= "
    <tr>
      <td>{$item->tombo}</td>
      <td>{$item->autor}</td>
      <td>{$item->titulo}</td>
      <td>{$item->volume}</td>
      <td>{$item->parte}</td>";
      if($item->moeda == "REAL") $html .= "<td>R$</td>";
      else $html .= "<td>$</td>"; 
      
    $html .= "
      <td>{$preco}</td>
    </tr>
    ";
    }

    $html .= "
  </tbody>
</table>";

    $soma = str_replace('.',',', $itens->sum("preco"));
    $html .= "
<div>
<br>
<div>
<label><b>Quantidade: {$itens->count()} </b></label>
</div>
<div style='width: 75%'></div>
<br>
<div>
<label><b>Preço: {$soma}</b></label>
</div>
</div>";

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
