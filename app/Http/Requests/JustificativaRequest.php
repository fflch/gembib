<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JustificativaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'justificativa_processamento' => 'required|max:500',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'justificativa_processamento.required' => 'Insira uma justificativa.',
            'justificativa_processamento.max' => 'Máximo de 500 caracteres.',
        ];
    }
}
