@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<!-- Default inline 1-->
<div class="row">
<h5>Selecione as opções para a estatística:</h5>
</div>
<form method="POST" action="/estatisticas">
	@csrf
  Intervalo da data:
  
  <div class="row">
  <div class="col-sm form-group">
      <input type="text" name="inicio" required>
    </div>
    <div class="col-sm form-group">
      <input type="text" name="fim" required>
    </div>
    
  </div>
  <small> <b>Exemplo: 30/11/2019 </b></small>
  <br><br><br>
  <div class="row">
  <div class="col-sm form-group">
          <label for="tipo_aquisicao">Tipo de aquisição:</label>
          <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
              <option value="">Selecionar tipo de aquisição</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Compra")
                selected
                @endif
              @endif
              >Compra</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Doação")
                selected
                @endif
              @endif
              >Doação</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Multa")
                selected
                @endif
              @endif
              >Multa</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Reposição")
                selected
                @endif
              @endif
              >Reposição</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Retombamento")
                selected
                @endif
              @endif
              >Retombamento</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Permuta")
                selected
                @endif
              @endif
              >Permuta</option>
          </select>
        </div>
      </div>
      
      <div class="col-sm form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option value="">Selecionar procedência</option>
          <option @if(isset($item))
              @if($item->procedencia=="NACIONAL")
                selected
                @endif
              @endif
          >NACIONAL</option>
          <option @if(isset($item))
              @if($item->procedencia=="INTERNACIONAL")
                selected
                @endif
              @endif
          >INTERNACIONAL</option>
        </select>
      </div>
   </div>
  </div>
  


  <div>
    <button type="submit" class="btn btn-success">Gerar estatística</button>
  </div>

</form>
@endsection
