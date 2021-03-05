<form method="POST" action="/processar_processamento/{{$item->id}}">
    @csrf 
    <div>
        <p>Enviado para {{$item->status}} por {{ Uspdev\Replicado\Pessoa::nomeCompleto($item->alterado_por) }} em {{$item->updated_at}}.</p>
        @include('item.observacao')
        <button type="submit" name="processar_processamento" class="btn btn-success" value="Em Processamento Técnico" onclick="return confirm('Mudar status para Em Processamento Técnico?')">Dar entrada ao Processamento Técnico</button>
        <button type="submit" name="processar_processamento" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Dar entrada/devolver ao Tombamento</button>

    </div>
</form>
