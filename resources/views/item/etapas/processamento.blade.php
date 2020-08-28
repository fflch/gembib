<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{ $item->status }} por {{ $item->alterado_por }} em {{ $item->data_processamento }}.</p>
    <p>Última alteração feita em: {{ $item->update_at }}<br><br>
    @include('item.observacao')
    <button type="submit" name="processar_processado" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Devolver para Tombamento</button>
    <button type="submit" name="processar_processado" class="btn btn-success" value="Processado" onclick="return confirm('Mudar status para Processado?')">Processar</button>
    </div>
</form>