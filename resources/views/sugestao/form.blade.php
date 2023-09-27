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
      <label for="ano">Ano:</label>
      <input type="text" id="ano" class="form-control" name='ano' value="{{old('ano')}}">
    </div>
    <br>
    <div>
      <label for="volume">Volume:</label>
      <input type="text" id="volume" class="form-control" name='volume' value="{{old('volume')}}">
    </div>
    <br>
    <div>
      <label for="tradutor">Tradutor(es):</label>
      <input type="text" id="tradutor" class="form-control" name='tradutor' value="{{old('tradutor')}}">
    </div>
    <br>
    <div>
      <label for="editora">Editora:</label>
      <input type="text" id="editora" class="form-control" name='editora' value="{{old('editora')}}">
    </div>
    <br>
    <div>
      <label for="edicao">Edição:</label>
      <input type="text" id="edicao" class="form-control" name='edicao' value="{{old('edicao')}}">
    </div>
    <br>
    <div>
      <label for="isbn">ISBN:</label>
      <input type="text" id="isbn" class="form-control" name='isbn' value="{{old('isbn')}}">
    </div>
    <br>
    <div>
      <label for="local">Local de publicação:</label>
      <input type="text" id="local" class="form-control" name='local' value="{{old('local')}}">
    </div>
    <br>
    <div>
      <label for="preco_editora">Preço na Editora:</label>
      <input type="text" id="preco_editora" class="form-control" name='preco_editora' value="{{old('preco_editora')}}">
    </div>
    <br>
    <div>
      <label for="area">Área:</label>
      <select name="area" class="btn btn-success mr-2">
        <option value="" selected="">Selecione um campo</option>
          @foreach($area as $a)
            <option @if(Request()->area == "$a") selected @endif>
              {{$a}}
            </option>
          @endforeach
      </select>
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
