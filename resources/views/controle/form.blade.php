@if(isset($controle->id))
<h4>Editar registro</h4>
@else 
<h4>Serviço de Processamento em Geral</h4>
@endif
<div class="row">
<div class="col-md form-group">
<label for="inicio">Data início:</label><br>
<input id="inicio" data-mask="00/00/0000" class="datepicker" style="width: 300px" value="{{ old('inicio', $controle->inicio) }}" name="inicio"/><br><br>
</div>
<div class="col-md form-group">
    <label for="fim">Data fim:</label><br>
    <input id="fim" data-mask="00/00/0000" class="datepicker" style="width: 300px" value="{{old('fim', $controle->fim)}}" name="fim"/><br><br>
</div>
<div class="col-md form-group">
    <label for="titulos_novos">TÍTULOS NOVOS:</label>
    <input type="text" id="titulos_novos" style="width: 300px" class="form-control" value="{{old('titulos_novos', $controle->titulos_novos)}}" name="titulos_novos" aria-describedby="titulos_novosHelpBlock"/>
    <small id="titulos_novosHelpBlock" class="form-text text-muted">
        *Qualquer material bibliográfico (Livros e outros materiais processados no ano).<br><br>
    </small>
</div>
<div class="col-md form-group">
    <label for="volumes">VOLUMES (Exemplar/Volume/Anexo):</label>
    <input type="text" id="volumes" style="width: 300px" class="form-control" value="{{old('volumes', $controle->volumes)}}" name="volumes" aria-describedby="volumesHelpBlock"/>
    <small id="volumesHelpBlock" class="form-text text-muted">
        *Todo material bibliográfico (Exemplar, Volume, Anexo) processado no ano.<br><br>
    </small>
</div>
</div>

<div class="row">
<div class="col-md form-group">
    <label for="consistencia_acervo">CONSISTÊNCIA DO ACERVO:</label>
    <input type="text" id="consistencia_acervo" style="width: 300px" class="form-control" value="{{old('consistencia_acervo', $controle->consistencia_acervo)}}" name="consistencia_acervo" aria-describedby="consistencia_acervoHelpBlock"/>
    <small id="consistencia_acervoHelpBlock" class="form-text text-muted">
        *Todo material bibliográfico já existente no acervo que foi revisado no ano.<br><br>
    </small>
    
</div>
<div class="col-md form-group">
    <label for="multimeios">MULTIMEIOS:</label>
    <input type="text" id="multimeios" style="width: 300px" class="form-control" value="{{old('multimeios', $controle->multimeios)}}" name="multimeios" aria-describedby="multimeiosHelpBlock"/>
    <small id="multimeiosHelpBlock" class="form-text text-muted">
        *Vídeo, gráfico, slides, fotografias, som, mapas, cartas.<br><br>
    </small>  
</div>
<div class="col-md form-group">
    <label for="servicos_tecnicos">SERVIÇOS TÉCNICOS:</label>
    <input type="text" id="servicos_tecnicos" style="width: 300px" class="form-control" value="{{old('servicos_tecnicos', $controle->servicos_tecnicos)}}" name="servicos_tecnicos" aria-describedby="servicos_tecnicosHelpBlock"/>
    <small id="servicos_tecnicosHelpBlock" class="form-text text-muted">
        *Processamento técnico, serviços administrativos, etc.<br><br>
    </small>
</div>
<div class="col-md form-group">
    <label for="remocoes_acervo">REMOÇÕES NO ACERVO:</label>
    <input type="text" id="remocoes_acervo" style="width: 300px" class="form-control" value="{{old('remocoes_acervo', $controle->remocoes_acervo)}}" name="remocoes_acervo" aria-describedby="remocoes_acervoHelpBlock"/>
    <small id="remocoes_acervoHelpBlock" class="form-text text-muted">
        *Todo registro já excluído do acervo.<br>
    </small>
</div>
</div>

<div class="row">
<div class="col-md form-group">
    <label for="outro_material">OUTRO TIPO DE MATERIAL:</label>
    <input type="text" id="outro_material" style="width: 300px" class="form-control" value="{{old('outro_material', $controle->outro_material)}}" name="outro_material"/><br>
</div>
<div class="col-md-9 mb-2">
    <label for="observacao">OBSERVAÇÃO:</label>
    <textarea class="form-control" id="observacao" name="observacao" rows="1">{{ $controle->observacao ?? old('observacao') }}</textarea>
</div>
</div>

