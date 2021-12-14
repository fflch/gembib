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
    private function search(){
        $request = request();
        $query = Item::where('status', 'Em Processamento Técnico')->orderBy('created_at', 'desc');     

        if(isset($request->titulo)) {
            $query->where('titulo',$request->titulo);
        }

        if(isset($request->autor)) {
            $query->where('autor',$request->autor);
        }
        
        if(isset($request->editora)) {
            $query->where('editora',$request->editora);
        }

        if(isset($request->ano)) {
            $query->where('ano',$request->ano);
        }

        return $query;
    }

    public function create(Request $request)
    {
        $this->authorize('aluno');
        $query = $this->search();
        $itens = $query->paginate(10);
        
        return view ('pedido.create',[
            'itens' => $itens,
            'query' => $query,
        ]);
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
