<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{ $item->status }} 
        @include('item.partials.alterado_por')
        @if($item->data_processado) 
            em {{ $item->data_processado }}.
        @endif
    </p> 
    
    <p>Última alteração feita em: {{ $item->updated_at }}</p>
        @can('admin')
            <button type="submit" name="processar_processado" class="btn btn-info" value="Em Processamento Técnico" onclick="return confirm('Mudar status para Em Processamento Técnico?')">Devolver para Em Processamento Técnico</button>
        @endcan
    </div>
</form>