<form method="POST" action="/processar_processamento/{{$item->id}}">
    @csrf 
    <div>
        <button type="submit" name="processamento" class="btn btn-info" value="Em Processamento Técnico">Enviar para Processamento Técnico</button>
    </div>
</form>