<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Item;

class ItemRequest extends FormRequest
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
        $tipo_aquisicao = Item::tipo_aquisicao;

        return [
            'titulo'           => 'required',
            'autor'            => 'required',
            'cod_impressao'    => 'required',
            'tipo_aquisicao'   => 'required|in:' . implode(',', $tipo_aquisicao),
            'tipo_material'    => 'required',
            'editora'          => 'required',
            'ano'              => 'integer',
            'tombo'            => '', 
            'tombo_antigo'     => '', 
            'parte'            => '', 
            'volume'           => '', 
            'fasciculo'         => '', 
            'local'            => '', 
            'colecao'          => '', 
            'isbn'             => '', 
            'link'             => '', 
            'edicao'           => '', 
            'departamento'     => '', 
            'prioridade'       => '', 
            'procedencia'      => '', 
            'finalidade'       => '', 
            'verba'            => '', 
            'processo'         => '', 
            'fornecedor'       => '', 
            'moeda'            => '', 
            'preco'            => '', 
            'nota_fiscal'      => '', 
            'data_tombamento'  => '', 
            'data_sugestao'    => '', 
            'observacao'       => '', 
            'capes'            => '', 
            'subcategoria'     => '',
            'escala'           => '',                            
        ];
    }
}
