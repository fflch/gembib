<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use PDF;

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
      $titulo = $request->titulo;

    	$itens = Item::where('cod_impressao', $request->cod_impressao)->get();

      $pdf = PDF::loadView('pdfs.relatorio', compact('itens','titulo'));
      return $pdf->download('relatorio.pdf');
    }
}
