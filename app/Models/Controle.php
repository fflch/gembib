<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Controle extends Model
{
    use HasFactory;
    protected $table = 'controles';
    protected $guarded = ['id'];
    protected $fillable = [
        'inicio', 
        'fim', 
        'titulos_novos',
        'volumes',
        'consistencia_acervo',
        'outro_material', 
        'multimeios', 
        'servicos_tecnicos', 
        'remocoes_acervo',
        'observacao',
    ];

    protected $dates = [
        'inicio',
        'fim'
    ];

    protected $dateFormat = 'Y-m-d';

    public function getInicioAttribute($value){//para exibir no formato dia-mes-ano
        if($value){
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setInicioAttribute($value){//para salvar no formato ano-mes-dia
        if($value){
            $this->attributes['inicio'] = Carbon::parse($value)->format('Y-m-d');
        }
    }

    public function getFimAttribute($value){
        if($value){
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setFimAttribute($value){
        if($value){
            $this->attributes['fim'] = Carbon::parse($value)->format('Y-m-d');
        }
    }  

}
