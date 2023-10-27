<?php


namespace App\Utils;
use App\Models\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Util {

    public static function limita_caracteres($texto, $limite, $quebra = true){
        $tamanho = strlen($texto);
        if($tamanho <= $limite){ // Verifica se o tamanho do texto é menor ou igual ao limite
            $novo_texto = $texto;
        }else{ // Se o tamanho do texto for maior que o limite
            if($quebra == true){ // Verifica a opção de quebrar o texto
                $novo_texto = trim(substr($texto, 0, $limite))."...";
            }else{ // Se não, corta $texto na última palavra antes do limite
                $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
                $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
            }
        }
        $texto_utf8 = iconv(mb_detect_encoding($novo_texto, mb_detect_order(), true) , 'ASCII//TRANSLIT//IGNORE', $novo_texto);
        return $texto_utf8; // Retorna o valor formatado
    }

    public static function quantidades(Request $request){

        $totals = DB::table('itens')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = 'Sugestão' then 1 end) as sugestao")
            ->selectRaw("count(case when status = 'Em Cotação' then 1 end) as cotacao")
            ->selectRaw("count(case when status = 'Em Licitação' then 1 end) as licitacao")
            ->selectRaw("count(case when status = 'Em Tombamento' then 1 end) as tombamento")
            ->selectRaw("count(case when status = 'Negado' then 1 end) as negado")
            ->selectRaw("count(case when status = 'Tombado' then 1 end) as tombado")
            ->selectRaw("count(case when status = 'Em Processamento Técnico' then 1 end) as processamento")
            ->selectRaw("count(case when status = 'Processado' then 1 end) as processado");

        if($request->has('campos')) {
            $campos = Item::campos;
            unset($campos['todos_campos']);
            foreach($request->campos as $key => $value) {
                $totals->when(!is_null($value) && !is_null($request->search[$key]),
                    function($query) use ($request, $campos, $key, $value) {
                        if($value == 'todos_campos'){
                            foreach($campos as $chave => $campo) {
                                $query->orWhere($chave, 'LIKE', '%' . $request->search[$key] . '%');
                            }
                        }
                        else {
                            $query->where($value,'LIKE', '%'.$request->search[$key].'%');
                        }
                    }
                );
            }
        }

        $totals->when($request->status, function($query) use ($request) {
            $query->where('status', '=', $request->status);
        });

        $totals->when($request->procedencia, function($query) use ($request) {
            $query->where('procedencia', '=', $request->procedencia);
        });

        $totals->when($request->tipo_material, function($query) use ($request) {
            $query->where('tipo_material', '=', $request->tipo_material);
        });

        $totals->when($request->tipo_aquisicao, function($query) use ($request) {
            $query->where('tipo_aquisicao', '=', $request->tipo_aquisicao);
        });

        $totals->when(($request->data_processamento_inicio) && ($request->data_processamento_fim), function($query) use ($request) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_processamento_inicio)->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', $request->data_processamento_fim)->format('Y-m-d');
            $query->whereBetween('data_processamento', [$from, $to]);
            $query->whereNotNull('data_processamento');
        });

        $totals->when(($request->data_tombamento_inicio) && ($request->data_tombamento_fim), function($query) use ($request) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_tombamento_inicio)->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', $request->data_tombamento_fim)->format('Y-m-d');
            $query->whereBetween('data_tombamento', [$from, $to]);
            $query->whereNotNull('data_tombamento');
        });
        //data de aquisição e data de tombamento são a mesma coisa, os setores chamam por nomes diferentes e resultou numa confusão entre os termos
        $totals->when(($request->data_aquisicao_inicio) && ($request->data_aquisicao_fim), function($query) use ($request) {
            $from =  Carbon::createFromFormat('d/m/Y', $request->data_aquisicao_inicio)->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', $request->data_aquisicao_fim)->format('Y-m-d');
            $query->whereBetween('data_tombamento', [$from, $to]);
            $query->whereNotNull('data_tombamento');
        });

        return $totals->first();
    }

    public static function reverse_string(string $string) {
        return implode('%', array_reverse(explode(' ', $string)));
    }
}
