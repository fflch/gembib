@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<form method="POST" action="/controle/{{$controle->id}}">
    @csrf
    @method('patch')
    
    @include('controle.form')

    <a href="/controle/" class="btn btn-success" onclick="">Voltar</a>
    <button type="submit" class="btn btn-info" value="editar" onclick="return confirm('Deseja editar o registro?');">Editar</button>
</form>	

@endsection