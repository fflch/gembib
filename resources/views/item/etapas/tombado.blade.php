<form method="POST" action="/processar_processamento/{{$item->id}}">
    @csrf 
    <div>
        <p>Enviado para {{$item->status}} 
        @include('item.partials.alterado_por') 
        em {{$item->updated_at}}.
        </p>
        @include('item.observacao')
        <button type="submit" name="processar_processamento" class="btn btn-info" value="Em Processamento Técnico" onclick="return confirm('Mudar status para Em Processamento?')">Solicitar Processamento Técnico</button>
    </div>
</form>