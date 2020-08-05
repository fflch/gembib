<form method="POST" action="/processar_licitacao/{{$item->id}}">
@csrf 
    <div>
        <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
        <button type="submit" name="processar_licitacao" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Começar Tombamento</button>
    </div>
</form>