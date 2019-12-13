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
          @foreach($status as $s)
            <option>{{ $s }}</option>
          @endforeach
        </select>
    </div>
</div>

<div class="form-group" id="hiddenMotivo" style="visibility: hidden; position: absolute; top: 200px; width: 250px; height: 50px; right: 890px;">
    <textarea class="form-control" id="motivo" rows="1" name="motivo" style="position: relative; resize: none;" placeholder="Digite o motivo"></textarea>
</div>

    @include('item/form')

</form>

@endsection
