@extends('laravel-usp-theme::master')

@section('javascripts_head')
@parent
    <script src="/js/item.js"></script>
@endsection

@section('content')
@include('flash')

<form method="POST" action="/processar/{{$item->id}}">
    @csrf    
    <div class="row">
    <div class="col-sm form-group" onchange="optionNegado()">
        <label for="status">Mudança de status</label>
        <select class="form-control" id="status" name="status">
          @foreach($alterar_status as $s)
            <option>{{ $s }}</option>
          @endforeach
        </select>
    </div>

<div class="col-sm form-group" id="hiddenMotivo" style="visibility: hidden;">
    <label for="motivo">Digite o motivo:</label>
    <textarea class="form-control" id="motivo" rows="1" name="motivo" placeholder="..."></textarea>
</div>
</div>
    @include('item/form')

</form>

@endsection
