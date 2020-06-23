@extends('laravel-usp-theme::master')

@section('javascripts_head')
@parent
    <script src="/js/item.js"></script>
@endsection

@section('content')
@include('flash')

<form method="POST" action="/processar/{{$item->id}}">
    @csrf    
    @include('item/form')
</form>

@endsection
