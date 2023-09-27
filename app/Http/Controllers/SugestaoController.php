<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;
use App\Mail\email_sugestao;

class SugestaoController extends Controller
{    
    private $area = Area::area;

    public function sugestaoForm()
    {
        $this->authorize('logado');
        return view('sugestao/form', [
            'area'  => $this->area,
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

        return redirect('/');
    }
}
