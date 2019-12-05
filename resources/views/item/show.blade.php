@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<div>
  <b>Processamento do livro:</b> {{ $item->titulo }} <br>
  <b>Status:</b> {{ $item->status }} <br>
  <b>Autor:</b> {{ $item->autor }}<br>
  <b>Editora:</b> {{ $item->editora }}<br>

</div>

@endsection
