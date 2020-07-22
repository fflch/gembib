<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;


class Item extends Model
{
    protected $table = 'itens';
    protected $guarded = ['id'];

    const status = [
        "Sugestão",
        "Em Cotação",
        "Em Licitação",
        "Em Tombamento",
        "Negado",
        "Tombado",
        "Em Processamento Técnico",
        "Processado"
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

    const tipo_aquisicao = [
        "Compra",
        "Doação",
        "Multa",
        "Reposição",
        "Retombamento",
        "Permuta"
    ];

    const prioridade = [
        "Coleção Didática"
    ];

    const departamento = [
        "Antropologia",
        "Ciência Politica",
        "Filosofia",
        "Geografia",
        "História",
        "Letras Modernas",
        "Letras Clássicas e Vernáculas",
        "Letras Orientais",
        "Linguística",
        "Sociologia",
        "Teoria Literária e Literatura Comparada"
    ];

    const subcategoria = [
        "Mestrado",
        "Doutorado",
        "Livre-docência"
    ];

    const verba = [
        "CAPES",
        "FAPESP",
        "RUSP",
        "CNPQ",
        "FAPLIVROS",
        "PROAP",
        "Outras"        
    ];

    const moeda = [
        "REAL",
        "DÓLAR"
    ];
    
    public function setPrecoAttribute($value){
        if($value){
            $this->attributes['preco'] = str_replace(',','.',$value);
        }
    }

    public function getPrecoAttribute($value){
        return str_replace('.', ',', $value);
    }
  
    public function getDataTombamentoAttribute(){
        return date('d/m/Y', strtotime($this->attributes['data_tombamento']));
    }

    public function getDataSugestaoAttribute(){
        return date('d/m/Y', strtotime($this->attributes['data_sugestao']));
    }

}
