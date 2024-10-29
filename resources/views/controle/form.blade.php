<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if(isset($controle->id))
                    <b>Editar registro</b>
                    @else
                    <b>Serviço de Processamento Geral</b>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label>Data Inicio</label>
                            <input type="text" data-mask="00/00/0000" class="form-control datepicker" name="inicio" value="{{old('inicio',$controle->inicio)}}">
                        </div>
                        <div class="col">
                            <label>Data Fim</label>
                            <input type="text" data-mask="00/00/0000" class="form-control datepicker" name="fim" value="{{old('fim',$controle->fim)}}">
                        </div>
                    </div>
                    <div class="row" style="margin-top:12px;">
                        <div class="col">
                            <label>TÍTULOS NOVOS</label>
                            <input type="text" class="form-control" name="titulos_novos" value="{{old('titulos_novos',$controle->titulos_novos)}}">
                            <small id="titulos_novosHelpBlock" class="form-text text-muted">
                                *Qualquer material bibliográfico (Livros e outros materiais processados no ano)
                            </small>
                        </div>
                        <div class="col">
                            <label>VOLUMES</label>
                            <input type="text" class="form-control" name="volumes" value="{{old('volumes',$controle->volumes)}}">
                            <small id="titulos_novosHelpBlock" class="form-text text-muted">
                            *Todo material bibliográfico (Exemplar, Volume, Anexo) processado no ano.
                            </small>
                        </div>
                        <div class="col">
                            <label>CONSISTÊNCIA DO ACERVO</label>
                            <input type="text" class="form-control" name="consistencia_acervo" value="{{old('consistencia_acervo',$controle->consistencia_acervo)}}">
                            <small id="titulos_novosHelpBlock" class="form-text text-muted">
                                *Todo material bibliográfico já existente no acervo que foi revisado no ano.
                            </small>
                        </div>
                        <div class="col">
                            <label>MULTIMEIOS</label>
                            <input type="text" class="form-control" name="multimeios" value="{{old('multimeios',$controle->multimeios)}}">
                            <small id="titulos_novosHelpBlock" class="form-text text-muted">
                                *Vídeo, gráfico, slides, fotografias, som, mapas, cartas.
                            </small>
                        </div>
                    </div>
                    <div class="row" style="margin-top:12px;">
                        <div class="col">
                            <label>SERVIÇOS TÉCNICOS</label>
                            <input type="text" class="form-control" name="servicos_tecnicos" value="{{old('servicos_tecnicos',$controle->servicos_tecnicos)}}">
                            <small id="titulos_novosHelpBlock" class="form-text text-muted">
                                *Processamento técnico, serviços administrativos, etc.
                            </small>
                        </div>
                        <div class="col">
                            <label>REMOÇÕES NO ACERVO</label>
                            <input type="text" class="form-control" name="remocoes_acervo" value="{{old('remocoes_acervo',$controle->remocoes_acervo)}}">
                            <small id="titulos_novosHelpBlock" class="form-text text-muted">
                                *Todo registro já excluído do acervo.
                            </small>
                        </div>
                        <div class="col">
                            <label>OUTRO TIPO DE MATERIAL</label>
                            <input type="text" class="form-control" name="outro_material" value="{{old('outro_material',$controle->outro_material)}}">
                        </div>
                    </div>
                    <div class="row" style="margin-top:12px;">
                        <div class="col">
                            <label>OBSERVAÇÃO</label>
                            <textarea type="text" class="form-control" name="observacao" rows="3">{{old('observacao',$controle->observacao)}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card{
        box-shadow:1px 1px 2px 1px rgb(0, 0, 0, 0.1);
    }
</style>