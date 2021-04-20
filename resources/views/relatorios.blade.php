@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/relatorios">
	 @csrf

  <h4>Relatório de Aquisição</h4><br>
  <div class="row">

    <div class="col-sm form-group">
      <label for="titulo">Título do relatório:</label>
      <input type="text" id="titulo" style="width: 540px" class="form-control" value="{{old('titulo')}}" name="titulo"/>
      <br>
      <label for="cod_impressao">Código de impressão:</label>
      <input type="text" id="cod_impressao" style="width: 540px" class="form-control" value="{{old('cod_impressao')}}" name="cod_impressao"/>
    </div>
  </div>

    <div>
      <button type="submit" class="btn btn-success"> Enviar </button>
    </div>
</form>

@endsection
