@extends('laravel-usp-theme::master')

@section('javascripts_head')
@parent
    <script src="/js/item.js"></script>
@endsection

@section('content')
@include('flash')

<div class="col-sm form-group">
<h5>Selecione as opções para a estatística:</h5>
</div>

<form method="POST" action="/estatisticas">
	@csrf
  Intervalo da data:
  
<div class="row">
  <div class="col-sm form-group">
      <input type="text" name="inicio" required>
      <input type="text" name="fim" required>
  </div>
</div>
  <small> <b>Exemplo: 30/11/2019 </b></small>
  <br><br>

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
      
<div class="row"> 
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

<div class="row" onchange="optionCheck()" style="position: relative; ">
  <div class="col-sm form-group">
    <label for="tipo_material">Tipo de material:</label>
    <select class="form-control" id="tipo_material" name="tipo_material">
          <option value=""></option>
    
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
<!--Textbox após a seleção de "Outros tipos" em "Tipos de materiais"-->
  <div class="col-sm form-group" style="visibility: hidden; position: absolute;">
        <input type="text" style="position: absolute; top: 60px; left: 120px;" id="outromaterial" name="outromaterial" placeholder="Digite outro tipo de material">
  </div>
    <!--Campo Subcategoria-->
  <div id="hiddenDiv" style="visibility:hidden; position: absolute;">
        <select class="form-control" id="subcategoria" name="subcategoria" style="position: relative; top: 60px; left: 120px;"> 
            <option value="">Selecionar subcategoria</option>
            <option>Mestrado</option>
            <option>Doutorado</option>
            <option>Livre-docência</option>
        </select>
  </div>
        <!--Campo Escala-->
  <div class="col-sm form-group" id="hiddenEscala" style="visibility: hidden; position: absolute;">
            <input type="text" style="position: absolute; top: 60px; left: 120px;" id="escala" name="escala" placeholder="Digite a escala do mapa">
  </div>
</div>

<br>

  <div>
    <button type="submit" class="btn btn-success">Gerar estatística</button>
  </div>

</form>
@endsection
