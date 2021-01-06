@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="GET">

<div class="row">
  <div class="col-sm form-group">
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

  <select name="tipo_material">
  <option value="" selected>Selecionar tipo de material</option>
    @foreach($tipo_material as $t)
      <option @if(Request()->tipo_material == "$t") selected @endif>
        {{$t}}
      </option>
    @endforeach
  </select>

  <select name="tipo_aquisicao">
  <option value="" selected>Selecionar tipo de aquisição</option>
    @foreach($tipo_aquisicao as $a)
      <option @if(Request()->tipo_aquisicao == "$a") selected @endif>
        {{$a}}
      </option>
    @endforeach
  </select>
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
  <b>Buscar pelo título, autor, tombo ou código de impressão:</b>
  <input type="text" name="busca" value="{{ Request()->busca }}">
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
      <label for="">Data Sugestão</label>
      <input type="text" name="data_sugestao_inicio" class="datepicker" value="{{ Request()->data_sugestao_inicio }}"> <b>-</b>
      <input type="text" name="data_sugestao_fim" class="datepicker" value="{{ Request()->data_sugestao_fim }}">
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
    <label for="">Data Tombamento</label>
    <input type="text" name="data_tombamento_inicio" class="datepicker" value="{{ Request()->data_tombamento_inicio }}"> <b>-</b>
    <input type="text" name="data_tombamento_fim" class="datepicker" value="{{ Request()->data_tombamento_fim }}">
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
    <label for="">Data Processamento</label>
    <input type="text" name="data_processamento_inicio" class="datepicker" value="{{ Request()->data_processamento_inicio }}"> <b>-</b>
    <input type="text" name="data_processamento_fim" class="datepicker" value="{{ Request()->data_processamento_fim }}">
  </div>
</div>

  <button type="submit" class="btn btn-success">buscar</button>
</form>
<br>

<div>
  <a href="/excel?status={{ request()->status }}
  &procedencia={{ request()->procedencia }}
  &tipo_material={{ request()->tipo_material }}
  &busca={{ request()->busca }}
  &data_sugestao_inicio={{ request()->data_sugestao_inicio }}
  &data_sugestao_fim={{ request()->data_sugestao_fim }}
  &data_tombamento_inicio={{ request()->data_tombamento_inicio }}
  &data_tombamento_fim={{ request()->data_tombamento_fim }}
  &data_processamento_inicio={{ request()->data_processamento_inicio }}
  &data_processamento_fim={{ request()->data_processamento_fim }}">
  <i class="fas fa-file-excel"></i> Exportar busca em excel</a>  
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
      <td>{{ $itens->total() }}</td>
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
      <td><a href="/item/{{ $item->id }}">{{ $item->tombo ?? 'Sem tombo' }}</a></td>
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

