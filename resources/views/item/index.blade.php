@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="GET" >
  <select name="status">
  <option value="" selected="">Selecionar o status</option>
    @foreach($status as $i)
      <option @if(Request()->status == "$i") selected @endif>
        {{$i}}
      </option>
    @endforeach
  </select>

  <select name="procedencia">
  <option value="" selected>Procedência</option>
    @foreach($procedencia as $p)
      <option @if(Request()->procedencia == "$p") selected @endif>
        {{$p}}
      </option>
    @endforeach
  </select>
  
  <b>Buscar pelo título, autor, tombo ou código de impressão:</b>
  <input type="text" name="busca" value="{{ Request()->busca }}">
  <button type="submit" class="btn btn-success">buscar</button>
</form>
<br>

<div>
  <a href="/excel?status={{ request()->status }}&procedencia={{ request()->procedencia }}&busca={{ request()->busca }}">
  <i class="fas fa-file-excel"></i>Exportar busca em excel</a>  
</div>
<br>
    {{ $itens->appends(request()->query())->links() }}
<table class="table table-striped">
  <thead>
  <tr align="center">
    <th scope="col">Sugestão</th>
    <th scope="col">Em Cotação:</th>
    <th scope="col">Em Licitação:</th>
    <th scope="col">Em Tombamento:</th>
    <th scope="col">Negado:</th>
    <th scope="col">Tombado:</th>
    <th scope="col">Em Processamento Técnico:</th>
    <th scope="col">Processado:</th>
    <th scope="col">Total de itens:</th>
    <th scope="col">Total por busca:</th>
  </tr>
  </thead>
  <tbody>
    <tr align="center">
      <td>{{ $sugestao }}</td>
      <td>{{ $cotacao }}</td>
      <td>{{ $licitacao }}</td>
      <td>{{ $tombamento }}</td>
      <td>{{ $negado }}</td>
      <td>{{ $tombado }}</td>
      <td>{{ $processamento }}</td>
      <td>{{ $processado }}</td>
      <td>{{ $total }}</td>
      <td>{{ $busca }}</td>
    </tr>
  </tbody>
</table>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Tombo</th>
      <th scope="col">Título</th>
      <th scope="col">Autor</th>
      <th scope="col">Editora</th>
      <th scope="col">Status</th>
      <th scope="col">Procedência</th>
      <th scope="col">Sugestão feita por</th>
    </tr>
  </thead>
  <tbody>
    @foreach($itens as $item)
    <tr>
      <td>{{ $item->tombo ?? 'Sem tombo' }}</td>
      <th><a href="/item/{{ $item->id }}">{{ $item->titulo }}</a></th>
      <td>{{ $item->autor }}</td>
      <td>{{ $item->editora }}</td>
      <td>{{ $item->status }}</td>
      <td>{{ $item->procedencia }}</td>
      <td>{{ $item->sugerido_por }}</td>

    </tr>
    @endforeach

  </tbody>
</table>

@endsection

