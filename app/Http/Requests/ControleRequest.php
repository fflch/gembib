<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ControleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inicio' => 'required|date',
            'fim' => 'required|date',
            'titulos_novos' => 'required|integer',
            'volumes' => 'required|integer',
            'consistencia_acervo' => 'required|integer',
            'outro_material' => 'required|integer',
            'multimeios' => 'required|integer',
            'servicos_tecnicos' => 'required|integer',
            'remocoes_acervo' => 'required|integer',
            'observacao' => 'nullable|string'
        ];
    }
}
