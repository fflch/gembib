<?php


namespace App\Utils;
use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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
    public static function quantidades($itens){
        $quantidades = [];

        $q = clone $itens;
        $quantidades['sugestao'] = $q->where('status', 'Sugestão')->count();

        $q = clone $itens;
        $quantidades['cotacao'] = $q->where('status', 'Em Cotação')->count();

        $q = clone $itens;
        $quantidades['licitacao'] = $q->where('status', 'Em Licitação')->count();

        $q = clone $itens;
        $quantidades['tombamento'] = $q->where('status', 'Em Tombamento')->count();

        $q = clone $itens;
        $quantidades['negado'] = $q->where('status', 'Negado')->count();

        $q = clone $itens;
        $quantidades['tombado'] = $q->where('status', 'Tombado')->count();

        $q = clone $itens;
        $quantidades['processamento'] = $q->where('status', 'Em Processamento Técnico')->count();

        $q = clone $itens;
        $quantidades['processado'] = $q->where('status', 'Processado')->count();
        return $quantidades;
    }

}
