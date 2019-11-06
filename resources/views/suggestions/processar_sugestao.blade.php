@extends('laravel-usp-theme::master')

@section('content')

<div>
  <b>Processamento do livro:</b> {{ $suggestion->titulo }} <br>
  <b>Status:</b> {{ $suggestion->status }} <br>
  <b>Autor:</b> <br>
  <b>Editora:</b> <br>
</div>
<br>

<form method="POST" action="/suggestions/store_processar_sugestao/{{$suggestion->id}}">
    @csrf
    <div class="form-group">
        <label for="status">Mudança de status</label>
        <select class="form-control" id="status" name="status">
          <option>Em processo de aquisição</option>
          <option>Negado</option>
        </select>
    </div>

 <div class="form-group">
    <label for="exampleFormControlTextarea1">Motivo caso for negado:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
    <button type="submit" class="btn btn-success">Enviar</button>
  </div>

</form>

@endsection
