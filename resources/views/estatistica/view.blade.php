@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<td>Estatística com o intervalo de data entre {{ date( 'd/m/Y' , strtotime($inicio))}} - {{ date( 'd/m/Y' , strtotime($fim))}}
<br> Resultado: <b>{{$resultado}}</b></td>

@endsection('content')