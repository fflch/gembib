<?php

namespace App\Http\Controllers;

use App\Models\Controle;
use App\Http\Requests\ControleRequest;
use Carbon\Carbon;
use PDF;

class ControleController extends Controller
{
    private function search(){
        $request = request();
        $query = Controle::orderByDesc('id');
        
        if (!empty($request->busca_inicio) && !empty($request->busca_fim)) {
            $from = Carbon::createFromFormat('d/m/Y', $request->busca_inicio)->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', $request->busca_fim)->format('Y-m-d');
            $query->where('inicio', '>=', $from);
            $query->where('fim', '<=', $to);
        }
        return $query;
    }
    
    public function index(Controle $controle)
    {
        $this->authorize('ambos');    
        $query = $this->search();  

        $registros = $query->paginate(12);

        return view('controle/index', ['registros' => $registros, 'controle' =>$controle,  'query' => $query]);
    }

    public function store(ControleRequest $request)
    {
        $this->authorize('ambos');
        
        $controle = Controle::create($request->validated()); 
        
        $controle->save();

        $request->session()->flash('alert-info',"Novo registro enviado com sucesso!");

        return redirect("/controle");
    }
    
    public function show(Controle $controle)
    {
        $this->authorize('ambos');

        return view('controle/show', compact('controle'));
    }

    public function edit(Controle $controle){
        $this->authorize('ambos');

        return view('controle.edit', compact('controle'));
    }

    public function update(Controle $controle, ControleRequest $request){
        $this->authorize('ambos');
        
        $controle->update($request->validated());

        $request->session()->flash('alert-info',"Registro {$controle->inicio} - {$controle->fim} atualizado com sucesso!");

        return redirect("/controle");
    }

    public function geraPDF(){
        $this->authorize('ambos');

        $query = $this->search(); 

        $registros = $query->get();

        $pdf = PDF::loadView('pdfs.controle', compact('registros'));
        return $pdf->download('relatorioSTL.pdf');
    }

}
