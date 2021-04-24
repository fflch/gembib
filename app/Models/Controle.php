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

    public function setInicioAttribute($value)
    {
        $this->attributes['inicio'] =  Carbon::parse($value);
    }

    public function setFimAttribute($value)
    {
        $this->attributes['fim'] =  Carbon::parse($value);
    }

}
