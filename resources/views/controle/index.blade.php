@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<form method="POST" action="/controle">
	@csrf
    
<h4>Serviço de Processamento em Geral</h4>
<div class="form-row">
    <div class="col-md-3 mb-3">
    <label for="inicio">Data início:</label><br>
    <input id="inicio" style="width: 400px" class="datepicker" value="{{old('inicio')}}" name="inicio"/><br><br>
</div>
    <div class="col-md-3 mb-3">
        <label for="fim">Data fim:</label><br>
        <input id="fim" style="width: 400px" class="datepicker" value="{{old('fim')}}" name="fim"/><br><br>
    </div>
    <div class="col-md-3 mb-3">
        <label for="titulos_novos">TÍTULOS NOVOS:</label>
        <input type="text" id="titulos_novos" style="width: 400px" class="form-control" value="{{old('titulos_novos')}}" name="titulos_novos" aria-describedby="titulos_novosHelpBlock"/>
        <small id="titulos_novosHelpBlock" class="form-text text-muted">
            *Qualquer material bibliográfico (Livros e outros materiais processados no ano).<br><br>
        </small>
    </div>
    <div class="col-md-3 mb-3">
        <label for="volumes">VOLUMES (Exemplar/Volume/Anexo):</label>
        <input type="text" id="volumes" style="width: 400px" class="form-control" value="{{old('volumes')}}" name="volumes" aria-describedby="volumesHelpBlock"/>
        <small id="volumesHelpBlock" class="form-text text-muted">
            *Todo material bibliográfico (Exemplar, Volume, Anexo) processado no ano.<br><br>
        </small>
    </div>
</div>

<div class="form-row">
    <div class="col-md-3 mb-3">
        <label for="consistencia_acervo">CONSISTÊNCIA DO ACERVO:</label>
        <input type="text" id="consistencia_acervo" style="width: 400px" class="form-control" value="{{old('consistencia_acervo')}}" name="consistencia_acervo" aria-describedby="consistencia_acervoHelpBlock"/>
        <small id="consistencia_acervoHelpBlock" class="form-text text-muted">
            *Todo material bibliográfico já existente no acervo que foi revisado no ano.<br><br>
        </small>
        
    </div>
    <div class="col-md-3 mb-3">
        <label for="multimeios">MULTIMEIOS:</label>
        <input type="text" id="multimeios" style="width: 400px" class="form-control" value="{{old('multimeios')}}" name="multimeios" aria-describedby="multimeiosHelpBlock"/>
        <small id="multimeiosHelpBlock" class="form-text text-muted">
            *Vídeo, gráfico, slides, fotografias, som, mapas, cartas.<br><br>
        </small>  
    </div>
    <div class="col-md-3 mb-3">
        <label for="servicos_tecnicos">SERVIÇOS TÉCNICOS:</label>
        <input type="text" id="servicos_tecnicos" style="width: 400px" class="form-control" value="{{old('servicos_tecnicos')}}" name="servicos_tecnicos" aria-describedby="servicos_tecnicosHelpBlock"/>
        <small id="servicos_tecnicosHelpBlock" class="form-text text-muted">
            *Processamento técnico, serviços administrativos, etc.<br><br>
        </small>
    </div>
    <div class="col-md-3 mb-3">
        <label for="remocoes_acervo">REMOÇÕES NO ACERVO:</label>
        <input type="text" id="remocoes_acervo" style="width: 400px" class="form-control" value="{{old('remocoes_acervo')}}" name="remocoes_acervo" aria-describedby="remocoes_acervoHelpBlock"/>
        <small id="remocoes_acervoHelpBlock" class="form-text text-muted">
            *Todo registro já excluído do acervo.<br>
        </small>
    </div>
</div>

<div class="form-row">
    <div class="col-md-3 mb-2">
        <label for="outro_material">OUTRO TIPO DE MATERIAL:</label>
        <input type="text" id="outro_material" style="width: 400px" class="form-control" value="{{old('outro_material')}}" name="outro_material"/><br>
    </div>
    <div class="col-md-8 mb-2">
        <label for="observacao">OBSERVAÇÃO:</label>
        <textarea class="form-control" id="observacao" name="observacao" rows="1">{{ $controle->observacao ?? old('observacao') }}</textarea>
    </div>
</div>

<div>
    <center><button type="submit" class="btn btn-success"> Enviar </button></center>
</div><br>

</form>

@include('controle.show')

@endsection