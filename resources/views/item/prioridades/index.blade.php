@extends('laravel-usp-theme::master')
@section('content')
@include('flash')
<div class="container-fluid">

<div class="row justify-content-center" style="margin-top:8px;">
    <div class="col-md-8">
        {{-- {{ $itens->appends(request()->query())->links() }} --}}
        <div class="card">
            <div class="card-header">
                <b>Itens com pedido de prioridade</b>
            </div>
            @forelse($itens as $item)
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <p><b>Título: </b><a href="/item/{{$item->id}}">{{$item->titulo}}</a></p>
                        <p><b>Autor: </b>{{$item->autor}}</p>
                        <p><b>Tombo: </b>{{$item->tombo}}</p>
                        @php
                            $newData = \Carbon\Carbon::parse($item->updated_at)->subDays(1);
                        @endphp
                        <p><b>Data do Pedido: </b>{{date('d/m/Y', strtotime($newData))}}</p>
                        <p><b>Requisitado por:</b>
                        {{ $item->name}} - {{ $item->email }}, {{ $item->codpes }}
                        </p>
                    </div>
                    </div>
                </div>
                <hr />
                @empty
                <div class="alert alert-info">Não foram encontrados itens em Prioridade</div>
                @endforelse
            </div>
        </div>
    </div>
</div>



@endsection
