@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/etiquetas">
    @csrf
    <div class="row">
            <div class="col-sm form-group">
              <label for="tombo_inicio">Tombo início:</label>
              <input type="text" id="tombo_inicio" class="form-control" name="tombo_inicio" value="{{old('tombo_inicio')}}"/>
            </div>
            <div class="col-sm form-group">
              <label for="tombo_fim">Tombo fim:</label>
              <input type="text" id="tombo_fim" class="form-control" name="tombo_fim" value="{{old('tombo_fim')}}"/>
            </div>
    </div>
    <div class="row">
            <div class="col-sm form-group">
              <label for="cod_impressao">Código de impressão:</label>
              <input type="text" id="cod_impressao" style="width: 540px" class="form-control" name="cod_impressao"/>
            </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success"> Enviar </button>
    </div>
  </div>
</form>


@endsection
