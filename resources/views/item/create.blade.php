@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<form method="POST" action="/item">
    @csrf
    @include('item/form')
    <div>
        <button type="submit" class="btn btn-info" value="salvar">Salvar</button>
    </div>
    
    <br>
</form>

@endsection