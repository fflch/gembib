@extends('laravel-usp-theme::master')
@section("content")

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <b>{{$item->titulo}}</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p><b>Autor: </b>{{$item->autor}}</p>
                            <p><b>Ano: </b>{{$item->ano}}</p>
                        </div>
                        <div class="col">
                            <p><b>ISBN: </b>{{$item->isbn}}</p>
                            <p><b>Status: </b>{{$item->status}}</p>
                        </div>
                    </div>
                    <hr />
                    <b>Justificativa</b>
                    <form method="post" action="prioridade/{{$item->id}}">
                        @csrf
                        @method("put")
                        <textarea rows="5" name="justificativa_processamento" class="form-control" required>{{old('justificativa_processamento', $item->justificativa_processamento)}}</textarea>
                        <button type="submit" class="btn btn-success" style="width:100%; margin-top:12px;">Pedir prioridade</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection