@extends('laravel-usp-theme::master')

@section('content')

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Título</th>
          <th scope="col">Autor</th>
          <th scope="col">Editora</th>
          <th scope="col">Status</th>
          <th scope="col">Processar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($suggestions as $suggestion)
        <tr>
          <th>{{ $suggestion->titulo }}</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td><a href="/suggestions/processar_sugestao/{{$suggestion->id}}">processar</a></td>
        </tr>
        @endforeach

      </tbody>
    </table>

@endsection

