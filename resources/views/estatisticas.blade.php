@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<!-- Default inline 1-->
<div class="row">
<h5>Selecione as opções para a estatística:</h5>
</div>
<form method="POST" action="/estatisticas">
	@csrf
<div class="row">
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio">Livros
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio">Multimeios
  </label>
</div>
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio">Outros tipos
  </label>
</div>
</div>
<div class="row">
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio2">Compra
  </label>
</div>
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio2">Doação
  </label>
</div>
</div>
<div class="row">
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio3">Internacional
  </label>
</div>
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio3">Nacional
  </label>
</div>
</div>
<div class="row">
<div>
        <button type="submit" class="btn btn-success">Gerar estatística</button>
    </div>
</div>

</form>
@endsection
