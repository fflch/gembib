<form method="POST" action="/processar_licitacao/{{$item->id}}">
@csrf 
    <div>
        <button type="submit" name="processar_licitacao" class="btn btn-info" value="Em Tombamento">Começar Tombamento</button>
    </div>
</form>