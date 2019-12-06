@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/processar/{{$item->id}}">
    @csrf
    <div class="form-group">
        <label for="status">Mudança de status</label>
        <select class="form-control" id="status" name="status">
          @foreach($status as $s)
            <option>{{ $s }}</option>
          @endforeach
        </select>
    </div>

<div class="form-group">
    <label for="motivo">Motivo caso for negado:</label>
    <textarea class="form-control" id="motivo" rows="3" name="motivo"></textarea>
</div>

    @include('item/form')

</form>

@endsection

