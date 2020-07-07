@extends('laravel-usp-theme::master')

@section('javascripts_head')
@parent
    <script src="/js/item.js"></script>
@endsection

@section('content')
@include('flash')

<h4><b>Selecione as opções para a estatística:</b></h4>
<form method="POST" action="/estatisticas">
	@csrf
  Intervalo da data
  
<div class="row">
  <div class="col-sm form-group">
      <input type="text" name="inicio" class="datepicker" required> <b>-</b>
      <input type="text" name="fim" class="datepicker" required>
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
          <label for="tipo_aquisicao">Tipo de aquisição:</label>
          <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
              <option value="">Selecionar tipo de aquisição</option>
              @foreach($tipo_aquisicao as $opcao)
              <option @if(isset($item)) 
                    @if($item->tipo_material=="$opcao")
                      selected 
                    @endif 
                  @endif
            >{{$opcao}}</option>
          @endforeach
    </select>
  </div>
</div>
      
<div class="row"> 
    <div class="col-sm form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option value="">Selecionar procedência</option>
          @foreach($procedencia as $option)
          <option @if(isset($item))
          @if($item->procedencia=="$option")
            selected
            @endif
            @endif
          >{{$option}}</option>
        @endforeach
        </select>
      </div>
</div>

<div class="row">
  <div class="col-sm form-group">
    <label for="tipo_material">Tipo de material:</label>
    <select class="form-control" id="tipo_material" name="tipo_material">
          <option value="">Selecionar tipo de material</option>
          @foreach($tipo_material as $tipo)
              <option @if(isset($item)) 
                    @if($item->tipo_material=="$tipo")
                      selected 
                    @endif 
                  @endif
            >{{$tipo}}</option>
          @endforeach
    </select>
</div>

</div>

<br>

  <div>
    <button type="submit" class="btn btn-success">Gerar estatística</button>
  </div>

</form>
@endsection
