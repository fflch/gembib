<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory;
    protected $table = 'itens';
    protected $guarded = ['id'];

    const status = [
        "Sugestão",
        "Em Cotação",
        "Negado",
        "Em Licitação",
        "Em Tombamento",
        "Tombado",
        "Em Processamento Técnico",
        "Processado"
    ];

    const campos = [
        'todos_campos' => 'Todos os Campos',
        'titulo' => 'Título',
        'ano' => 'Ano',
        'autor' => 'Autor',
        'tombo' => 'Tombo',
        'verba' => 'Verba',
        'processo' => 'Processo',
        'cod_impressao' => 'Código de Impressão',
        'observacao' => 'Observação',
    ];

    const campos_sugestao = [
        'todos_campos' => 'Todos os Campos',
        'ano' => 'Ano',
        'titulo' => 'Título',
        'autor' => 'Autor',
        'observacao' => 'Observação',
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
        "Obra especial",
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
        "Permuta",
        "Retombamento"
    ];

    const prioridade = [
        0 => "Coleção Didática",
        1 => "Obras adquiridas Reserva Técnica (FAPESP, CNPQ etc)",
        2 => "Obras adquiridas Verba RUSP",
        3 => "Obras adquiridas – verbas específicas",
        4 => "Doações específicas e de Docentes"
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

    const filters = [
        'titulo' => 'Título',
        'autor' => 'Autor',
        'tombo' => 'Tombo',
        'cod_impressao' => 'Código de Impressão',
        'observacao' => 'Observação',
        'verba' => 'Verba',
        'processo' => 'Processo'
    ];

    public function setPrecoAttribute($value){
        if($value){
            $this->attributes['preco'] = str_replace(',','.',$value);
        }
    }

    public function getPrecoAttribute($value){
        return number_format($value, 2, ',', '');
    }

    public function getSauAttribute(){
        $codpes = env("SAU");
        if(empty($codpes)) return [];
        return explode(",",$codpes);
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
            return  Carbon::parse($this->attributes['updated_at'])->format('d/m/Y');
        }
    }

    public function getPrioridadeAttribute($value){
        if(array_key_exists($value,self::prioridade)){
            return $value . ' - ' .  self::prioridade[$value];
        }
        return $value;
    }

    public static function etiquetaOptions(){
        return[
            'A4256',
            '6182',
            '3080',
            '3081',
            '3082',
            '3180',
            '3181',
            '3182',
            '5580A',
            '5580M',
            '5580V',
            '6080',
            '6081',
            '6082',
            '6083',
            '6084',
            '6085',
            '6086',
            '6087',
            '6088',
            '6089',
            '6092',
            '6093',
            '6094',
            '6095',
            '6180',
            '6181',
            '6182',
            '6183',
            '6184',
            '6185',
            '6187',
            '62580',
            '62581',
            '62582',
            '6280',
            '6281',
            '6282',
            '6283',
            '6284',
            '6285',
            '6286',
            '6287',
            '6288',
            '6293',
            '7088',
            '7089',
            '7188',
            '8096',
            '8098',
            '8099F',
            '8099L',
            '8196',
            '8296',
            'A4048',
            'A4049',
            'A4050',
            'A4051',
            'A4054',
            'A4054R',
            'A4055',
            'A4056',
            'A4056R',
            'A4060',
            'A4062',
            'A4063',
            'A4063R',
            'A4067',
            'A4248',
            'A4249',
            'A4250',
            'A4251',
            'A4254',
            'A4255',
            'A4256',
            'A4260',
            'A4261',
            'A4262',
            'A4263',
            'A4264',
            'A4265',
            'A4267',
            'A4268',
            'A4348',
            'A4349',
            'A4350',
            'A4351',
            'A4354',
            'A4355',
            'A4356',
            'A4360',
            'A4361',
            'A4362',
            'A4363',
            'A4364',
            'A4365',
            'A4367',
            'A4368',
            'BOOP100x40',
        ];
    }
}
