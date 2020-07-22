@extends('laravel-usp-theme::master')

@section('content')
@include('flash')


<td>Estatística com o intervalo de data entre <b>{{ $inicio }} - {{ $fim }} </b></td><br><br>
@if(isset($tipo_aquisicao))
    <td>Tipo de aquisição:<b> {{ $tipo_aquisicao }} </b><td><br>
@endif

@if(isset($tipo_material))
    <td>Tipo de material:<b> {{ $tipo_material }} </b></td><br>
@endif

@if(isset($procedencia))
    <td>Procedência:<b> {{ $procedencia }} </b></td><br>
@endif
<br> 
Resultado: <b>{{$resultado}}</b></td>

@endsection('content')