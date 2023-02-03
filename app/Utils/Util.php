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

        $quantidades['sugestao'] = $itens->where('status', 'Sugestão')->count();

        $quantidades['cotacao'] = $itens->where('status', 'Em Cotação')->count();

        $quantidades['licitacao'] = $itens->where('status', 'Em Licitação')->count();

        $quantidades['tombamento'] = $itens->where('status', 'Em Tombamento')->count();

        $quantidades['negado'] = $itens->where('status', 'Negado')->count();

        $quantidades['tombado'] = $itens->where('status', 'Tombado')->count();

        $quantidades['processamento'] = $itens->where('status', 'Em Processamento Técnico')->count();

        $quantidades['processado'] = $itens->where('status', 'Processado')->count();
        return $quantidades;
    }

}
