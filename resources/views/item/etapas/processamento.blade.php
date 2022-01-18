<script src="/js/item.js"></script>
<p>
    Enviado para {{ $item->status }} 
    @include('item.partials.alterado_por') 
    @if($item->data_processamento)
    em {{ $item->data_processamento }}.
    @endif
</p>
<p>Última alteração feita em: {{ $item->updated_at }}.</p><br>

   @include('item.observacao')

<div class="card">
    <div class="card-body">
        <h4>Infos sobre a Etiqueta de Lombada </h4>
        @if(empty($item->no_cutter))
            <br>
            @include('item.partials.etiqueta_lombada')
            <button type="submit" name="etiqueta_lombada" class="btn btn-success"> Cadastrar Lombada </button>
        </form>
        @else
            <br>
            @include('item.partials.etiqueta_lombada')
        <span>
            <button type="submit" name="etiqueta_lombada" class="btn btn-success" onclick="return confirm('Alterar a etiqueta de lombada?')"> Atualizar Lombada </button>
        </form>
        <span>
    </div>
</div>

<br><br>
<form method="POST" action="/processar_processado/{{$item->id}}">
    <button type="submit" name="processar_processado" class="btn btn-success" value="Processado" onclick="return confirm('Mudar status para Processado?')">Processar</button>
    <button type="submit" name="processar_processamento" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Dar entrada/devolver ao Tombamento</button>
    <br><br>
</form>
@endif