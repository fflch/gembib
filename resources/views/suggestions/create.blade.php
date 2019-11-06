@extends('laravel-usp-theme::master')

@section('content')

<form>

  <div class="form-group">

  <form method="POST" action="/create">

    <div>
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" class="col-sm-3" >
    </div>
    
    <div>
      <label for="autor">Autor:</label>
      <input type="text" class="col-sm-3" id="autor">
    </div>

    <div>
      <label for="editora">Editora:</label>
      <input type="text" class="col-sm-3" id="editora">
    </div>

    <div>
      <label for="ano">Ano:</label>
      <input type="text" class="col-sm-3" id="ano">
    </div>

    <div>
      <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>


    </form>

  </div>

</form>
@endsection
