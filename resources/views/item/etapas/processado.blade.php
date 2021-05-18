<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{ $item->status }} por {{ Uspdev\Replicado\Pessoa::nomeCompleto($item->alterado_por) }} em {{ $item->data_processado }}.</p>
    @if(isset($item->recebido_sau_por) && $item->recebido_sau_por != NULL && $item->recebido_sau_por != "")
        <p>Entregue para bibliotecário(a) SAU: {{ Uspdev\Replicado\Pessoa::nomeCompleto($item->recebido_sau_por) }}.
    @endif
    <p>Última alteração feita em: {{ $item->updated_at }}</p>
    <button type="submit" name="processar_processado" class="btn btn-info" value="Em Processamento Técnico" onclick="return confirm('Mudar status para Em Processamento Técnico')">Devolver para Em Processamento Técnico</button>
    </div>
</form>