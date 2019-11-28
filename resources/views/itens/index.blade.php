@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

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
          <th>{{ $item->titulo }}</th>
          <td>{{ $item->autor }}</td>
          <td>{{ $item->editora }}</td>
          <td>{{ $item->status }}</td>
          <td><a href="/itens/disparar_email">{{ Auth::user()->email }}</td><!--mostrar email do usuário que fez cada sugestão-->
          <td><a href="/itens/processar_sugestao/{{$item->id54}}">processar</a></td>
        </tr>
        @endforeach

      </tbody>
    </table>

@endsection

