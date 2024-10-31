@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/controle" autocomplete="off">
	@csrf

    @include('controle.form')
    

@if(!isset($controle->id))
<div class="row justify-content-center" style="margin-top:12px;">
    <div class="col-3">
        <button type="submit" class="btn btn-success" value="enviar" style="width:100%;">Enviar</button>
    </div>
</div>
<br>
@endif

</form>

@include('controle.show')

@endsection