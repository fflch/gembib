@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

    <form method="GET" >

      <select name="status">
      <option value="" selected>Selecionar o status</option>
        @foreach($status as $i)
          <option>{{$i}}</option>
        @endforeach
      </select>
      <input type="text" name="busca">
      <button type="submit" class="btn btn-success">buscar</button>
    </form>
    <br>



    <table class="table table-striped">
      <thead>
        <tr>
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
          <th><a href="/item/{{ $item->id }}">{{ $item->titulo }}</a></th>
          <td>{{ $item->autor }}</td>
          <td>{{ $item->editora }}</td>
          <td>{{ $item->status }}</td>
          <td><a href="/itens/disparar_email">{{ Auth::user()->email }}</td><!--mostrar email do usuário que fez cada sugestão-->
          <td><a href="/processar/{{$item->id}}">processar</a></td>
        </tr>
        @endforeach

      </tbody>
    </table>

@endsection

