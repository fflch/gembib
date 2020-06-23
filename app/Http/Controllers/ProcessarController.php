<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Utils\Util;

use Maatwebsite\Excel\Excel;
use App\Exports\ExcelExport;

class ProcessarController extends Controller
{
    
    private $status = Item::status;
    private $procedencia = Item::procedencia;

    private function search(){
        $request =  request();
        $query = Item::orderBy('created_at', 'desc');

        if (isset($request->status) && !empty($request->status)) {
            $query->where(function ($p) use (&$request) {
            $p->where('status','=',$request->status);
            });
        }

        if (isset($request->procedencia) && !empty ($request->procedencia)) {
            $query->where(function ($s) use (&$request) {
            $s->where('procedencia','=',$request->procedencia)
              ->orwhere('procedencia','=',$request->procedencia);
            });
        }

        if (isset($request->busca) && !empty($request->busca)) {
            $query->where(function ($q) use (&$request) {
                $q->where('titulo','LIKE', '%' . $request->busca . '%')
                  ->orWhere('autor','LIKE', '%' . $request->busca . '%')
                  ->orwhere('tombo','LIKE', '%' . $request->busca . '%')
                  ->orwhere('cod_impressao','LIKE', '%' . $request->busca . '%');
            });
        }

        return $query;
    }

    public function processarIndex()
    {
        $this->authorize('sai');
        $status = $this->status;
        $procedencia = $this->procedencia;
        $query = $this->search();
        $itens = $query->paginate(10);
        return view('processar/index',compact('itens','status','procedencia'));
    }

    public function excel(Excel $excel){
        $query = $this->search();
        $headings = ['isbn','titulo','autor','editora','data_sugestao','data_tombamento'];
        $campos = ['ISBN', 'Título', 'Autor', 'Editora', 'Data de sugestão', 'Data de tombamento'];
        $itens = $query->get($headings)->toArray();
        $export = new ExcelExport($itens,$campos);
        return $excel->download($export, 'busca.xlsx');
          
    }

    public function processarForm(Item $item)
    {
        $this->authorize('sai');
        $status = $this->status;
        $areas = Area::all();
        $tipo_material = Item::tipo_material;

        /* Pegando o próximo tompo disponível */
        if(empty($item->tombo)) {
            $proximo = Item::max('tombo') + 1;
        } else {
            $proximo = null;
        }

        
    }

    public function processar(Request $request, Item $item)
    {
        $this->authorize('sai');
        Util::gravarNoBanco($request, $item);
        $request->session()->flash('alert-info', "Sugestão processada com sucesso.");

        return redirect("/item/{$item->id}");
    }

    public function processarSugestao(Request $request, Item $item){
        if ($request->processar_sugestao == 'Em Cotação'){
            $item->status = 'Em Cotação';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para cotação");
            return redirect("/item/{$item->id}");
        }

        if ($request->processar_sugestao == 'Em Tombamento'){
            $areas = Area::all();
            $item->status = 'Em Tombamento';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para Em tombamento");
            return view('processar/form',compact('item','areas'));
        }

        if ($request->processar_sugestao == 'Negado'){
            
            $request->validate([
                'motivo' => 'required'
            ]);

            $item->status = 'Negado';
            $item->save();
            $request->session()->flash('alert-info', "Status do item mudado para negado");
            return redirect("/item/{$item->id}");
        }

       
    }
}
