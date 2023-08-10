<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Item;
use App\Models\Area;

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
        $item = new Item;

        /* Códigos de área capes */
        $codigos = array_column(Area::select('codigo')->get()->toArray(), 'codigo');

        return [
            'titulo'           => 'required',
            'autor'            => 'required',
            'cod_impressao'    => 'required',
            'tipo_aquisicao'   => ['required', Rule::in($item::tipo_aquisicao)],
            'tipo_material'    => ['required', Rule::in($item::tipo_material)],
            'editora'          => 'required',
            'ano'              => 'required|max:6|',
            'tombo'            => '',
            'tombo_antigo'     => '',
            'parte'            => 'nullable',
            'volume'           => 'nullable',
            'sysno'           => 'nullable',
            'fasciculo'         => 'nullable',
            'local'            => '',
            'colecao'          => '',
            'isbn'             => 'nullable',
            'link'             => '',
            'edicao'           => 'nullable|integer',
            'departamento'     => ['nullable', Rule::in($item::departamento)],
            'prioridade'       => ['nullable', Rule::in(array_keys($item::prioridade))],
            'procedencia'      => ['required', Rule::in($item::procedencia)],
            'finalidade'       => '',
            'verba'            => ['nullable', Rule::in($item::verba)],
            'processo'         => '',
            'fornecedor'       => '',
            'moeda'            => ['nullable', Rule::in($item::moeda)],
            'preco'            => '',
            'nota_fiscal'      => '',
            'data_tombamento'  => 'date',
            'data_sugestao'    => 'date',
            'observacao'       => '',
            'capes'            => ['nullable',Rule::in($codigos)],
            'subcategoria'     => ['nullable', Rule::in($item::subcategoria)],
            'escala'           => '',
            'pedido_por'       => '',
            'data_processamento'  => 'date',
            'data_sau'         => 'date',
            'data_tombamento_nova' => 'nullable|date',
            'data_processamento_novo' => 'nullable|date',
        ];
    }

}
