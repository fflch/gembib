@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<form method="POST" action="/controle/">
    @csrf
    @include('controle/form')
</form>

@endsection