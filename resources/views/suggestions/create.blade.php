@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/suggestions">
    @csrf
    <div class="form-group">

      <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" class="form-control" name="titulo">
      </div>
      <br>
      <div>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" class="form-control" name="autor"> 
      </div>
      <br>
      <div>
        <label for="editora">Editora:</label>
        <input type="text" id="editora" class="form-control" name='editora'>
      </div>
      <br>
      <div>
        <button type="submit" class="btn btn-success"> Enviar </button> 
      </div>

  </div>
</form>
@endsection
