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
        'inicio', 'fim', 'titulos_novos', 'volumes', 'consistencia_acervo',
        'outro_material', 'multimeios', 'servicos_tecnicos', 'remocoes_acervo',
        'observacao',
    ];

    protected $dates = ['inicio', 'fim'];

    public function getInicioAttribute($value){
        if($value){
            return Carbon::CreateFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    public function getFimAttribute($value){
        if($value){
            return Carbon::CreateFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

}
