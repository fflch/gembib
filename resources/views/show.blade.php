@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Tombo:</th>
      <th scope="col">Autor:</th>
      <th scope="col">Título:</th>
      <th scope="col">Volume:</th>
      <th scope="col">Parte:</th>
      <th scope="col">Moeda:</th>
      <th scope="col">Preço:</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($itens as $item)
    <tr>
      <td>{{ $item->tombo }}</td>
      <td>{{ $item->autor }}</td>
      <td>{{ $item->titulo }}</td>
      <td>{{ $item->volume }}</td>
      <td>{{ $item->parte }}</td>
      <td>@if($item->moeda == "REAL") R$
      @else $
  	  @endif</td>
      <td>{!! str_replace('.',',', $item->preco) !!}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="row">
<div class="col-sm form-group">
<label>Quantidade: {{$itens->count()}} </label>
</div>
<div style="width: 75%"></div>
<div class="col-sm form-group">
<label>Preço: {!! str_replace('.',',', $itens->sum("preco"))!!}</label>
</div>
</div>

@endsection