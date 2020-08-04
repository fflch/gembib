@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

@include('item.etapas')

<table class="table table-striped">
  <tbody>
    <tr>
      <th scope="col">Tombo:</th>
      <td scope="row">{{ $item->tombo ?? 'Ainda não tombado' }}</td>
    </tr>
    <tr>
      <th scope="col">Código de impressão:</th>
      <td scope="row">{{ $item->cod_impressao ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Título: </th>
      <td scope="col">{{ $item->titulo }}</td>
    </tr>
    <tr>
      <th scope="col"><b>Status:</b></th>
      <td scope="col">{{ $item->status }}</td>
    </tr>
    <tr>
      <th scope="col">Sugerido por:</th>
      <td scope="col">{{ $item->sugerido_por }}</td>
    </tr>
    <tr>
      <th scope="col">Data da sugestão:</th>
      <td scope="col">{{ $item->data_sugestao }}</td>
    </tr>
    <tr>
      <th scope="col">Autor:</th>
      <td scope="row">{{ $item->autor }}</td>
    </tr>
    <tr>
      <th scope="col">Editora:</th>
      <td scope="row">{{ $item->editora }}</td>
    </tr>
    <tr>
      <th scope="col">Tipo de material:</th>
      <td scope="row">{{ $item->tipo_material ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Tipo de aquisição:</th>
      <td scope="row">{{ $item->tipo_aquisicao ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Edição:</th>
      <td scope="row">{{ $item->edicao ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Ano de publicação:</th>
      <td scope="row">{{ $item->ano ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Volume:</th>
      <td scope="row">{{ $item->volume ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Parte:</th>
      <td scope="row">{{ $item->parte ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Fascículo:</th>
      <td scope="row">{{ $item->fasciculo ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Coleção:</th>
      <td scope="row">{{ $item->colecao ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Local:</th>
      <td scope="row">{{ $item->local ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Link:</th>
      <td scope="row">{{ $item->link ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Pedido por:</th>
      <td scope="row">{{ $item->pedido_por ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Escala:</th>
      <td scope="row">{{ $item->escala ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Subcategoria:</th>
      <td scope="row">{{ $item->subcategoria ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Departamento:</th>
      <td scope="row">{{ $item->departamento ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Capes:</th>
      <td scope="row">{{ $campos ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">ISBN:</th>
      <td scope="row">{{ $item->isbn ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Tombo antigo:</th>
      <td scope="row">{{ $item->tombo_antigo ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Prioridade:</th>
      <td scope="row">{{ $item->prioridade ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Procedência:</th>
      <td scope="row">{{ $item->procedencia ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Finalidade:</th>
      <td scope="row">{{ $item->finalidade ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Processo:</th>
      <td scope="row">{{ $item->processo ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Verba:</th>
      <td scope="row">{{ $item->verba ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Fornecedor:</th>
      <td scope="row">{{ $item->fornecedor ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Nota fiscal:</th>
      <td scope="row">{{ $item->nota_fiscal ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Moeda:</th>
      <td scope="row">{{ $item->moeda ?? 'Não cadastrado' }}</td>
    </tr>
    <tr>
      <th scope="col">Preço:</th>
      <td scope="row">{{ $item->preco ?? 'Não cadastrado' }}</td>
    </tr>
      <th scope="col">Observações:</th>
      <td scope="row">{{ $item->observacao ?? 'Não cadastrado' }}</td>
    </tr>
  </tbody>
</table>

@endsection





