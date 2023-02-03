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
      <br>
      <div class="row justify-content-md-left">
      <div class="col col-lg-2">
        <label for="">Data de Sugestão</label>
      </div>
      <div class="col-md-lg-2">
        <input type="text" data-mask="00/00/0000" name="data_sugestao_inicio" class="datepicker" value="{{ Request()->data_sugestao_inicio }}"> <b>-</b>
      </div>
      <div class="col col-lg-2">
        <input type="text" data-mask="00/00/0000" name="data_sugestao_fim" class="datepicker" value="{{ Request()->data_sugestao_fim }}">
      </div>
    </div>
    <br>
    <div class="row justify-content-md-left">
      <div class="col col-lg-2">
        <label for="">Data Processamento</label>
      </div>
      <div class="col-md-lg-2">
        <input type="text" data-mask="00/00/0000" name="data_processamento_inicio" class="datepicker" value="{{ Request()->data_processamento_inicio }}"> <b>-</b>
      </div>
      <div class="col col-lg-2">
        <input type="text" data-mask="00/00/0000" name="data_processamento_fim" class="datepicker" value="{{ Request()->data_processamento_fim }}">
      </div>
    </div>
    <br>
    </div>
  </div>

    <div>
      <button type="submit" class="btn btn-success"> Enviar </button>
    </div>
</form>

@endsection
