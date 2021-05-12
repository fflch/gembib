@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/controle" autocomplete="off">
	@csrf

    @include('controle.form')
    

@if(!isset($controle->id))
<div>
    <center><button type="submit" class="btn btn-success" value="enviar">Enviar</button></center>
</div>
<br>
@endif

</form>

@include('controle.show')

@endsection