@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

    <div>
        <a href="/etiquetas" class="btn btn-success"> Gerar Etiquetas</a>
    </div>
    <br>
    <form method="GET" >

      <select name="status">
      <option value="" selected>Selecionar o status</option>
        @foreach($status as $i)
          <option>{{$i}}</option>
        @endforeach
      </select>
      
      <b>Buscar pelo tombo:<b>
      <input type="text" name="busca">
      <button type="submit" class="btn btn-success">buscar</button>
    </form>
    <br>
    <br>

    {{ $itens->appends(request()->query())->links() }}
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Tombo</th>
          <th scope="col">Título</th>
          <th scope="col">Autor</th>
          <th scope="col">Editora</th>
          <th scope="col">Status</th>
          <th scope="col">Sugestão feita por</th>
          <th scope="col">Processar</th>
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
          <td>{{ $item->sugerido_por }}</td>
          <td><a href="/processar/{{$item->id}}">processar</a></td>
        </tr>
        @endforeach

      </tbody>
    </table>

@endsection

