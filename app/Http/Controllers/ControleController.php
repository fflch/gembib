<?php

namespace App\Http\Controllers;

use App\Models\Controle;
use App\Http\Requests\ControleRequest;

class ControleController extends Controller
{
    public function index(Controle $controle)
    {
        $this->authorize('sai');        

        $registros = Controle::orderByDesc('id')->paginate(12);

        return view('controle/index', ['registros' => $registros, 'controle' =>$controle]);
    }

    public function store(ControleRequest $request)
    {
        $this->authorize('sai');
        
        $validated = $request->validated();

        $controle = Controle::create($validated); 
        
        $controle->save();

        $request->session()->flash('alert-info',"Novo registro enviado com sucesso!");

        return redirect("/controle");
    }
    
    public function show(Controle $controle)
    {
        $this->authorize('sai');

        return view('controle/show', compact('controle'));
    }

    public function edit(Controle $controle){
        $this->authorize('sai');

        return view('controle.edit', with(['controle' => $controle]));
    }

    public function update(Controle $controle, ControleRequest $request){
        $this->authorize('sai');

        $validated = $request->validated();
        
        $controle->update($validated);

        $request->session()->flash('alert-info',"Registro {$controle->inicio} - {$controle->fim} atualizado com sucesso!");

        return redirect("/controle");
    }

}
