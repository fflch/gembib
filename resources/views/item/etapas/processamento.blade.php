<script src="/js/item.js"></script>
<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{ $item->status }} 
    @include('item.partials.alterado_por') 
    @if($item->data_processamento)
        em {{ $item->data_processamento }}.
    @endif
    </p>
    <p>Última alteração feita em: {{ $item->updated_at }}.</p><br>

    @include('item.observacao')

<br>
    <button type="submit" name="processar_processamento" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Dar entrada/devolver ao Tombamento</button>
    <button type="submit" name="processar_processado" class="btn btn-success" value="Processado" onclick="return confirm('Mudar status para Processado?')">Processar</button>
    </div>
</form>