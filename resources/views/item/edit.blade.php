@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<form method="POST" action="/item/{{$item->id}}">
    @csrf
    @method('patch')

        @include('item.form')

    <button type="submit" class="btn btn-info" value="editar">Editar</button>
</form>	

@endsection