@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

@section('styles')
  @parent
  <link rel="stylesheet" type="text/css" href="{{asset('/css/stepper.css')}}">
@endsection('styles')

<div class="md-stepper-horizontal orange">

    @foreach ($item::status as $status)
      <div class="md-step editable
        @if($item->status == $status) 
          active
        @else
          next
        @endif
      ">
        <a href="#">
          <div class="md-step-circle"><span></span></div>
          <div class="md-step-title">{{ $status }}</div>
          <div class="md-step-optional"></div>
        </a>
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
      </div>
    @endforeach
</div>
<div>
    @if( !empty($item->tombo_antigo))
        <b> Tombo Antigo: </b> {{ $item->tombo_antigo}}
    @endif
    <br>
        <b> Tombo Atual: </b>  {{ $item->tombo}} 
    <br><br>
<form method="POST" action="/item/{{$item->id}}">
    @csrf
    @method('patch')

        @include('item.form')

    <button type="submit" class="btn btn-info" value="editar">Editar</button>
</form>	

@endsection