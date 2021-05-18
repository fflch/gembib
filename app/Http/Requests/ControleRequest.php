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
            'inicio' => 'required|date_format:"d/m/Y"',
            'fim' => 'required|date_format:"d/m/Y"',
            'titulos_novos' => 'nullable|integer',
            'volumes' => 'nullable|integer',
            'consistencia_acervo' => 'nullable|integer',
            'multimeios' => 'nullable|integer',
            'servicos_tecnicos' => 'nullable|integer',
            'remocoes_acervo' => 'nullable|integer',
            'outro_material' => 'nullable|integer',
            'observacao' => 'nullable'
        ];
    }
}
