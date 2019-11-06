@extends('laravel-usp-theme::master')

@section('content')

<form>
<div class="form-group">
    <label for="exampleFormControlSelect1">Mudança de status</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Em processo de aquisição</option>
      <option>Negado</option>

    </select>
  </div>

</form>

<br>

<form>

 <div class="form-group">
    <label for="exampleFormControlTextarea1">Motivo caso for negado:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
    <button type="button" class="btn btn-success">Enviar</button>
  </div>

</form>

@endsection
