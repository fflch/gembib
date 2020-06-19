<?php


namespace App\Utils;
use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Rules\TomboRule;

class Util {

    const status = [
        "Sugestão",
        "Comprado",
        "Negado",
        "Cotação",
        "Em Licitação",
        "Esgotado",
        "Tombado",
        "Inativo"
    ];

    const procedencia = [
        "INTERNACIONAL",
        "NACIONAL"
    ];

    const tipo_material = [
        "Livro",
        "Mapas",
        "Material Especial",
        "Memorial",  
        "Multimeios",
        "Obra rara",
        "Periódico",
        "CD/DVD",
        "Tese",
        "Outros Tipos"
    ];

    public static function gravarNoBanco(Request $request, Item $item){

        if($request->status == 'Negado') {
            $request->validate([
                'motivo'  => 'required',
            ]);
            $item->motivo = $request->motivo;
        } else {
            $request->validate([
                'tombo' => ['required','integer', new TomboRule($item)],
                'titulo'           => 'required',
                'autor'            => 'required',
                'cod_impressao'    => 'required',
                'tipo_aquisicao'   => 'required',
                'tipo_material'    => 'required',
                'editora'          => 'required',
            ]);
        }

        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->tombo = $request->tombo;
        $item->tombo_antigo = $request->tombo_antigo;
        $item->tipo_aquisicao = $request->tipo_aquisicao;
        $item->tipo_material = $request->tipo_material;
        $item->parte = $request->parte;
        $item->volume = $request->volume;
        $item->fasciculo = $request->fasciculo;
        $item->local = $request->local;
        $item->colecao = $request->colecao;
        $item->isbn = $request->isbn;
        $item->link = $request->link;
        $item->edicao = $request->edicao;
        $item->dpto = $request->dpto;
        $item->prioridade = $request->prioridade;
        $item->procedencia = $request->procedencia;
        $item->finalidade = $request->finalidade;
        $item->verba = $request->verba;
        $item->processo = $request->processo;
        $item->fornecedor = $request->fornecedor;
        $item->moeda = $request->moeda;
        if(!empty($request->preco)){
            $item->preco = str_replace(',','.',$request->preco);
        } else {
            $item->preco = null;
        }
        $item->nota_fiscal = $request->nota_fiscal;
        $item->data_tombamento = Carbon::now();
        $item->data_sugestao = Carbon::now();
        $item->cod_impressao = $request->cod_impressao;
        $item->observacao = $request->observacao;
        $item->capes = $request->capes;

        /*Outra prioridade*/
        $outraPrioridade = $request->outraPrioridade;
        if($request->prioridade == 'Outra'){
            $item->prioridade = $outraPrioridade;
        }
        /*fim outra prioridade*/

        /*Outra verba*/
        $outraVerba = $request->outraVerba;
        if($request->verba == 'Outras'){
            $item->verba = $outraVerba;
        }
        /*fim outra verba*/

        //Salvar valor escolhido em Subcategoria 
        $subcategoria = $request->subcategoria;//name
        if($request->tipo_material == 'Teses'){
            $item->subcategoria = $subcategoria;
        }
        //Salvar valor digitado em Tipo de Material
        $outroMaterial = $request->outromaterial;        
        if($request->tipo_material == 'Outros'){
            $item->tipo_material = $outroMaterial;
        }
        //Salvar valor digitado em Escala
        $valorescala = $request->escala;
        if($request->tipo_material == 'Mapas'){
            $item->escala = $valorescala;
        }

        /*if($request->status == 'Negado') {
            $request->validate([
                'motivo'  => 'required',
            ]);
            $item->motivo = $request->motivo;
        }*/

        // No caso de inserção direta, o status estava salvando como null, por isso o if.
        $item->status = $request->status;
        if($item->status ?? $item->status = "Tombado");

        
        $item->save();

    }


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
        return $novo_texto; // Retorna o valor formatado
    }

}
