
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
      </tr>
    </thead>
  <tbody>
      @foreach($suggestions as $suggestion)
      <tr>
        <th>{{ $suggestion->titulo }}</th>
        <td>{{ $suggestion->autor }}</td>
        <td>{{ $suggestion->editora }}</td>
        <td>{{ $suggestion->status }}</td>
      </tr>
        @endforeach

  </tbody>
</table>


<!--<body>
  <select id='select' name='select'>
    <option value=''>Selecione</option>
    <option value='div1'>Outros</option>
  </select>
https://www.youtube.com/watch?v=GQ_rzUtvt0c
<br>
  <div id='div1'>
    <input type='text' id='form'>
  </div>
</body>-->


@endsection