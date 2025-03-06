<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Mail;
use App\Mail\mail_processado;

class PrioridadeController extends Controller
{

    public function __invoke(Request $request)
    {
        $item = Item::findOrFail($request->item);
        if($item->prioridade_processamento != 1){
            $item->prioridade_processamento = 1;
            $item->pedido_usuario = $request->email;
            $item->save();
            Mail::to($request->email)->queue(new mail_processado());
        }

        return response()->json(['success' => true]);
    }

}
