<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <button type="submit" name="processar_processado" class="btn btn-info" value="Em Tombamento">Devolver para Tombamento</button>
        <button type="submit" name="processar_processado" class="btn btn-success" value="Processado">Processar</button>
    </div>
</form>