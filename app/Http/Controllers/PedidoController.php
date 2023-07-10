<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mail;
use App\Mail\email_pedido;

class PedidoController extends Controller
{

    public function create(Request $request)
    {
        $this->authorize('logado');

        $itens = Item::where('status', 'Em Processamento Técnico')
            ->when($request->titulo, function ($query) use ($request) {
                $query->where('titulo', 'like', "%$request->titulo%");
            })
            ->when($request->autor, function ($query) use ($request) {
                $string = explode(' ', $request->autor);
                $string_reverse = array_reverse($string);
                $string = implode('%',$string);
                $string_reverse = implode('%', $string_reverse);
                $query->where('autor', 'like', '%' . $string . '%');
                $query->orWhere('autor', 'like', '%' . $string_reverse . '%');
            })
            ->when($request->editora, function ($query) use ($request) {
                $query->where('editora', 'like', "%$request->editora%");
            })
            ->when($request->ano, function ($query) use ($request) {
                $query->where('ano', $request->ano);
            })
            ->orderBy('created_at', 'desc')->paginate(10);

        return view ('pedido.create', [ 'itens' => $itens ]);
    }

    public function pedidoItem(Request $request)
    {
        if($request->session()->exists('itens')) {
            $itens = $request->session()->get('itens');
            if(in_array($request->item, $itens)) {
                $key = array_search($request->item, $itens);
                $request->session()->forget("itens.$key");
            }
            else {
                $request->session()->push('itens', $request->item);
            }
        }
        else {
            $request->session()->put('itens', [$request->item]);
        }
        $request->session()->save();

    }

    public function email_pedido(Request $request)
    {
        $itens = $request->session()->get('itens');
        Mail::queue(new email_pedido($itens));
        $request->session()->forget('itens');

        return redirect()->route('pedido.create');
    }
}
