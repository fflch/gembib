<script src="/js/item.js"></script>
@csrf 
<p>
    Enviado para {{ $item->status }} 
    @include('item.partials.alterado_por') 
    @if($item->data_processamento)
    em {{ $item->data_processamento }}.
    @endif
        </p>
        <p>Última alteração feita em: {{ $item->updated_at }}.</p><br>
        
        @include('item.observacao')

        <br>
        
        <div class="row">
            <div class="form-group">
                <div class="form-group col-sm-2">
                    <input type="text" name="noclassificacao" value="{{ request()->noclassificacao }}"placeholder="No. Classificação">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-2">
                    <input type="text" name="nocutter" value="{{ request()->nocutter }}" placeholder="No. Cutter">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-2">
                    <input type="text" name="volume" value="{{ request()->volume }}" placeholder="Volume">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-2">
                    <input type="text" name="parte" value="{{ request()->parte }}" placeholder="Parte"> 
                </div>
            </div>
        </div>
        
<div class="row">
    <div class="form-group">
        <div class="form-group col-sm-2">
            <input type="text" name="edicao" value="{{ request()->edicao  }}" placeholder="Edição"> 
        </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
            <input type="text" name="ano" value="{{ request()->ano  }}" placeholder="Ano"> 
        </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
            <input type="text" name="exemplar" value="{{ request()->exemplar  }}" placeholder="Exemplar"> 
        </div>
    </div>
</div>
    <button type="submit" name="etiqueta_lombada" class="btn btn-success"> Gerar Etiqueta de Lombada </button>
    <br><br>
</form>
<form method="POST" action="/processar_processado/{{$item->id}}">
    <button type="submit" name="processar_processamento" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Dar entrada/devolver ao Tombamento</button>
    <button type="submit" name="processar_processado" class="btn btn-success" value="Processado" onclick="return confirm('Mudar status para Processado?')">Processar</button>
    <br><br>
</form>