@extends('laravel-usp-theme::master')

@section('content')

<form method="POST" action="/suggestions">
    @csrf
    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" class="col-sm-3" name="titulo">
    </div>
    
    <div>
      <label for="autor">Autor:</label>
      <input type="text" class="col-sm-3" id="autor" name="autor"> 
    </div>

    <div>
      <label for="editora">Editora:</label>
      <input type="text" class="col-sm-3" id="editora">
    </div>

    <div>
      <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>

</form>
@endsection
