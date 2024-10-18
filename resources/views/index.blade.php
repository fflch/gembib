@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<h3>Sistema para Gestão de Material Bibliográfico</h3>

Consulte nosso acervo público na busca abaixo: 
<br><br>

<form method="get">
<div class="row">
    <div class=" col-sm input-group">
    <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="Buscar por títutlo, autor, tombo ou código de impressão">

    <span class="input-group-btn">
        <button type="submit" class="btn btn-success"> Buscar </button>
    </span>

    </div>
</div>
</form><br>

Para fazer sugestões de compra, acesse o sistema com sua <a href="{{ route('login') }}">Senha Única</a> da Universidade de São Paulo.

@if(request()->search)

@include('item.partials.quantidades')
{{ $itens->appends(request()->query())->links() }}

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Tombo</th>
      <th scope="col">Título</th>
      <th scope="col">Autor</th>
      <th scope="col">Prioridade</th>
    </tr>
  </thead>
  <tbody>
    @foreach($itens as $item)
    <tr>
      <td>{{ $item->status }}</td>
      <td>{{ $item->tombo ?? 'Sem tombo' }}</td>
      <th>{{ $item->titulo }}</th>
      <td>{{ $item->autor }}</td>
      @if(!$item->prioridade_processamento)
      <td>
        <a href="prioridades/justificativa/{{$item->id}}" class="btn btn-primary" name="prioridade">
          Pedir prioridade
        </a>
      </td>
      @else
      <td><p class="text-info" style="margin:2px;">Prioridade pedida</p></td>
      @endif
    </tr>
    @endforeach

  </tbody>
</table>

{{ $itens->appends(request()->query())->links() }}
@endif

@endsection('content')
