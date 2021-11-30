@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

{{ $itens->appends(request()->query())->links() }}

<div class="card">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Selecionar</th>
        <th scope="col">Título</th>
        <th scope="col">Autor</th>
        <th scope="col">Editora</th>
        <th scope="col">Ano</th>
      </tr>
    </thead>
    <tbody>
      @foreach($itens as $item)
      <tr>
        <td align="center"><input type="checkbox" name="item[]" value="{{ $item->id }}"></td>
        <th>{{ $item->titulo }}</th>
        <td>{{ $item->autor }}</td>
        <td>{{ $item->editora }}</td>
        <td>{{ $item->ano }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<br>
<button type="submit" onclick="return confirm('Tem certeza que deseja solicitar esse(s) livro(s)');" class="btn btn-success" name="pedido">Realizar Pedido</button>
@endsection

