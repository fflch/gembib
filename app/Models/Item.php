<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory;
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
        "Coleção Didática",
        "1",
        "2",
        "3",
        "4"
    ];

    const departamento = [
        "Antropologia",
        "Ciência Politica",
        "Filosofia",
        "Geografia",
        "História",
        "Letras Clássicas e Vernáculas",
        "Letras Modernas",
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
        "CNPQ",
        "FAPESP",
        "FAPLIVROS",
        "FFLCH",
        "RUSP",
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
        return number_format($value, 2, ',', '');
    }
    
    public function getDataTombamentoAttribute($value){
        if($value){
            return Carbon::CreateFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    public function getDataSugestaoAttribute($value){
        if($value){
            return Carbon::CreateFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    public function getDataProcessamentoAttribute($value){
        if($value){
            return Carbon::CreateFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    public function getDataProcessadoAttribute($value){
        if($value){
            return Carbon::CreateFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        if($value){
            return Carbon::CreateFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
        }
    }
}

