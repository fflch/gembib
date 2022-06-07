@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/sugestao">
  @csrf
  <div class="form-group">
  <h4>Preencha os campos e faça uma sugestão:</h4><br>
    <div>
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" class="form-control" name="titulo" value="{{old('titulo')}}">
    </div>
    <br>
    <div>
      <label for="autor">Autor(es):</label>
      <input type="text" id="autor" class="form-control" name="autor" value="{{old('autor')}}">
    </div>
    <br>
    <div>
      <label for="editora">Editora:</label>
      <input type="text" id="editora" class="form-control" name='editora' value="{{old('editora')}}">
    </div>
    <br>
    <div>

      <label for="ano">Ano de publicação:</label>
      <input type="text" id="ano" class="form-control" name='ano' value="{{old('ano')}}">
    </div>
    <br>
    <div>
      <label for="isbn">ISBN:</label>
      <input type="text" id="isbn" class="form-control" name='isbn' value="{{old('isbn')}}">
    </div>
    <br>    
    <div>
      <label for="informacoes">Outras informações:</label>
      <textarea class="form-control" id="informacoes" rows="3" name="informacoes">{{ old('informacoes') }}</textarea>
    </div>
    <br>
    <div>
      <button type="submit" class="btn btn-success"> Enviar </button>
    </div>
  </div>
</form>


@endsection
