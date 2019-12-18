@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/relatorios">
	 @csrf
<div class="row">
            <div class="col-sm form-group">
              <label for="cod_impressao">Código de impressão:</label>
              <input type="text" id="cod_impressao" style="width: 540px" class="form-control" name="cod_impressao"/>
            </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success"> Enviar </button>
  </div>
</form>

@endsection