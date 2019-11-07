<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

    /* Etapa 1 - Sugestão */
    public function index()
    {
        // select * from suggestion where status="Sugestão"
        $suggestions = Suggestion::where('status',"Sugestão")->get();
        return view('suggestions/index',compact('suggestions'));
    }

    public function create()
    {
        return view('suggestions/create');
    }

    public function store(Request $request)
    {
        /* pegar itens que estão chegando e salvar no banco de dados */
        $suggestion = new Suggestion;
        $suggestion->titulo = $request->titulo;
        $suggestion->autor = $request->autor;
        $suggestion->editora = $request->editora;

        $suggestion->status = "Sugestão";
        $suggestion->save();
        return redirect('/');
    }


    /* Etapa 2 - Processar Sugestão */
    public function processar_sugestao(Suggestion $suggestion)
    {
        return view('suggestions/processar_sugestao',compact('suggestion'));
    }

    public function store_processar_sugestao(Request $request, Suggestion $suggestion)
    {
        /* Alterar status */
        $suggestion->status = $request->status;

        /*Salvar o motivo*/
        $suggestion->motivo = $request->motivo;

        $suggestion->save();
        return redirect('/suggestions');        
    }

}
