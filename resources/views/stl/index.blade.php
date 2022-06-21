@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

    <form method="GET">
        <input name="search">
        <button type="submit">Buscar</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Título</th>
            </tr>
        </thead>
        <tbody>
        @foreach($itens as $item)
            <tr>
                <td>{{ $item->titulo }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>




@endsection