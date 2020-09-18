<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\DB;

class MigracaoController extends Controller
{
    public function migracao(){
        // EU sei que existe uma tabela chamada: acervonormalizado que queremos juntas com itens!
        $normalizados = DB::table('acervonormalizado')->get();

        foreach ($normalizados as $normalizado) {
            $item = Item::where('tombo',$normalizado->tombo)->first();
            if(!$item) {
                $item = new Item;
            }
            $item->created_at = $normalizado->created_at;
            $item->sugerido_por = $normalizado->sugerido_por;
            $item->save();
        }
    }
}
