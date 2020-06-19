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
    private $status = Util::status;
    private $procedencia = Util::procedencia;

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
        $headings = ['tombo','titulo','autor','editora','status','procedencia','sugerido_por'];
        $itens = $query->get($headings)->toArray();
        $export = new ExcelExport($itens,$headings);
        return $excel->download($export, 'busca.xlsx');
          
    }

    public function processarForm(Item $item)
    {
        $this->authorize('sai');
        $status = $this->status;
        $areas = Area::all();
        $tipo_material = Util::tipo_material;

        /* Pegando o próximo tompo disponível */
        if(empty($item->tombo)) {
            $proximo = Item::max('tombo') + 1;
        } else {
            $proximo = null;
        }

        return view('processar/form',compact('item','status','areas','tipo_material','proximo'));
    }

    public function processar(Request $request, Item $item)
    {
        $this->authorize('sai');
        Util::gravarNoBanco($request, $item);
        $request->session()->flash('alert-info', "Sugestão processada com sucesso.");

        return redirect("/item/{$item->id}");
    }
}
