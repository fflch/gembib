<form method="POST" action="/enviar_processamento/{{$item->id}}">
    @csrf 
    <div>
        <p>Enviado para {{$item->status}} por {{$item->alterado_por}} em {{$item->updated_at}}.</p>
        @include('item.observacao')
        <button type="submit" name="enviar_processamento" class="btn btn-info" value="Em Trânsito" onclick="return confirm('Mudar status para Em Trânsito?')">Solicitar Processamento Técnico</button>
    </div>
</form>