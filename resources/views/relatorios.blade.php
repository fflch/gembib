@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <b>Relatório de aquisição</b>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <form method="POST" action="/relatorios">
                @csrf
              <label for="titulo_relatorio">Título do relatório:</label>
              <input type="text" id="titulo_relatorio" class="form-control" value="{{old('titulo_relatorio')}}" name="titulo_relatorio"/>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4">
              <input class="form-control" type="text" name="titulo" value="{{ request()->titulo }}" placeholder="Busca por Título">
            </div>
            <div class="col-4">
              <input class="form-control" type="text" name="autor" value="{{ request()->autor }}" placeholder="Busca por Autor">
            </div>
            <div class="col-4">
              <input class="form-control" type="text" name="tombo" value="{{ request()->tombo }}" placeholder="Busca por Tombo">
            </div>
          </div>
          <div class="row" style="margin-top:12px;">
            <div class="col-3">
              <input class="form-control" type="text" name="cod_impressao" value="{{ request()->cod_impressao }}" placeholder="Busca por Código de Impressão">
            </div>
            <div class="col-3">
              <input class="form-control" type="text" name="observacao" value="{{ request()->observacao }}" placeholder="Busca por Observação">
            </div>
            <div class="col-3">
              <input class="form-control" type="text" name="verba" value="{{ request()->verba }}" placeholder="Busca por Verba">
            </div>
            <div class="col-3">
              <input class="form-control" type="text" name="processo" value="{{ request()->processo }}" placeholder="Busca por Processo">
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col">
              <label>Data de Sugestão</label>
              <div class="row">
                <div class="col-4">
                  <input type="text" data-mask="00/00/0000" name="data_sugestao_inicio" class="form-control datepicker" value="{{ Request()->data_sugestao_inicio }}">
                </div>
                <div class="col-4">
                  <input type="text" data-mask="00/00/0000" name="data_sugestao_fim" class="form-control datepicker" value="{{ Request()->data_sugestao_fim }}">
                </div>
              </div>
            </div>
            <div class="col">
              <label>Data de Tombamento</label>
              <div class="row">
                <div class="col-4">
                  <input type="text" data-mask="00/00/0000" name="data_tombamento_inicio" class="form-control datepicker" value="{{ Request()->data_tombamento_inicio }}">
                </div>
                <div class="col-4">
                  <input type="text" data-mask="00/00/0000" name="data_tombamento_fim" class="form-control datepicker" value="{{ Request()->data_tombamento_fim }}">
                </div>
              </div>
            </div>
            <div class="col">
              <label>Data de Processamento</label>
              <div class="row">
                <div class="col-4">
                  <input type="text" data-mask="00/00/0000" name="data_processamento_inicio" class="form-control datepicker" value="{{ Request()->data_processamento_inicio }}">
                </div>
                <div class="col-4">
                  <input type="text" data-mask="00/00/0000" name="data_processamento_fim" class="form-control datepicker" value="{{ Request()->data_processamento_fim }}">
                </div>
              </div>
            </div>
          </div>
          <hr />
          <button type="submit" class="btn btn-success">Enviar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  input{
    box-shadow:1px 1px 1px rgb(0, 0, 0, 0.1);
  }
  .card{
    box-shadow:1px 1px 5px 1px rgb(0, 0, 0, 0.1);
  }
</style>
@endsection
