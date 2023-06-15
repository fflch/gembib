@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/relatorios">
	 @csrf

  <h4>Relatório de Aquisição</h4><br>

  <label for="titulo">Título do relatório:</label>
  <input type="text" id="titulo" style="width: 540px" class="form-control" value="{{old('titulo')}}" name="titulo"/>
  <br>

  <div class="row">

  <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="titulo" value="{{ request()->titulo }}" placeholder="Busca por Título">
      </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="autor" value="{{ request()->autor }}" placeholder="Busca por Autor">
      </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="tombo" value="{{ request()->tombo }}" placeholder="Busca por Tombo">
      </div>
    </div>
    <div class="form-group">
      <div class="form-group col-sm-2">
        <input type="text" name="codigoimpressao" value="{{ request()->codigoimpressao  }}" style="width: 300px" placeholder="Busca por Código de Impressão">
      </div>
    </div>
</div>
<div class="row">
  <div class="form-group">
    <div class="form-group col-sm-2">
        <input type="text" name="observacao" value="{{ request()->observacao }}" placeholder="Busca por Observação">
      </div>
    </div>
    <div class="form-group">
      <div class="form-group col-sm-2">
        <input type="text" name="verba" value="{{ request()->verba }}" placeholder="Busca por Verba">
      </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="processo" value="{{ request()->processo }}" placeholder="Busca por Processo">    </div>
      </div>
    </div>
</div>
</div>

<div class="row justify-content-md-left">
  <div class="col col-lg-2">
    <label for="">Data Sugestão</label>
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
    <label for="">Data Tombamento</label>
  </div>
  <div class="col-md-lg-2">
    <input type="text" data-mask="00/00/0000" name="data_tombamento_inicio" class="datepicker" value="{{ Request()->data_tombamento_inicio }}"> <b>-</b>
  </div>
  <div class="col col-lg-2">
    <input type="text" data-mask="00/00/0000" name="data_tombamento_fim" class="datepicker" value="{{ Request()->data_tombamento_fim }}">
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

  <button type="submit" class="btn btn-success mr-2">Enviar</button>

    </div>
</form>

@endsection
