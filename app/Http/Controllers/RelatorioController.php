<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;
use PDF;
use DB;

class RelatorioController extends Controller
{
    public function form(){
        $this->authorize('ambos');
        return view('relatorios');
    }

    public function show(Request $request){
      $this->authorize('ambos');
      $data_relatorio = Carbon::now()->format('d-m-Y');
      
      //na relatorio.pdf existem as variáveis titulo e titulo_relatorio. A titulo é utilizada para a pesquisa e a titulo_relatorio dará nome ao relatório criado
      $request->validate([
          'cod_impressao'  => 'required',
          'titulo_relatorio'  => 'required'
      ]);
      $titulo_relatorio = $request->titulo_relatorio;
      $itens = Item::where('cod_impressao', $request->cod_impressao)->get();
      
      $soma = DB::table('itens')->select('preco')->where('cod_impressao', $request->cod_impressao)->get();
      $total = $soma->sum('preco');

      $pdf = PDF::loadView('pdfs.relatorio', compact('itens','titulo_relatorio','total', 'data_relatorio'));
      $pdf->output();
      $dom_pdf = $pdf->getDomPDF();

      $canvas = $dom_pdf ->get_canvas();
      $canvas->page_text(0, 0, "Página {PAGE_NUM} de {PAGE_COUNT} - Data: $data_relatorio", null, 10, array(0, 0, 0));
      return $pdf->download('relatorio.pdf');
    }
}

