@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        <b>Etiquetas</b>
        </div>
        <div class="card-body">
          <form method="POST" action="/etiquetas">
            @csrf

            <div class="row">
              <div class="col">
                <label for="tombo_inicio">Tombo início:</label>
                <input type="text" id="tombo_inicio" class="form-control" name="tombo_inicio" value="{{old('tombo_inicio')}}"/>
              </div>
              <div class="col">
                <label for="tombo_fim">Tombo fim:</label>
                <input type="text" id="tombo_fim" class="form-control" name="tombo_fim" value="{{old('tombo_fim')}}"/>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <label for="cod_impressao">Código de impressão:</label>
                <input type="text" id="cod_impressao"
                class="form-control" name="cod_impressao" value="{{isset($cod_impressao) ? $cod_impressao : ''}}"/>
              </div>
              <div class="col">
                <label for="etiquetaPimaco">Escolha o tipo de etiqueta</label>
                <select class="form-control" name="etiquetaPimaco">
                  @foreach($itens::etiquetaOptions() as $item)
                  <option value="{{$item}}">{{$item}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col">
                <label>Margem em pixels</label>
                <input type="number" name="margem" class="form-control" />
              </div>
            </div>

            @if(isset($intervalos))
            <label for="pag_inicio">Página inicial: </label>
            <input type="number" id="pag_inicio" class="form-control" name="pag_inicio" min="1" max="{{$totalPages}}" value="{{old('pag_inicio')}}"/>
            <label for="pag_fim">Página final:</label>
            <input type="number" id="pag_fim" class="form-control" name="pag_fim" min="1" max="{{$totalPages}}" value="{{old('pag_fim')}}"/>
            @endif
            

            <div class="row" style="margin-top:12px;">
              <div class="col-2">
                <button name="etiqueta" type="submit" class="btn btn-success" value="tombo"> Etiqueta de Tombo </button>
              </div>
              <div class="col-2">
                <button name="etiqueta" type="submit" class="btn btn-success" value="lombada"> Etiqueta de Lombada </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  input, select{
    margin-top:-8px;
    margin-bottom:22px;
  }
  .card{
    box-shadow:1px 1px 5px 1px rgb(0, 0, 0, 0.1);
  }
</style>

@endsection
