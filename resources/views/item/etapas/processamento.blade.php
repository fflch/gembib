<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
    <button type="submit" name="processar_processado" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Devolver para Tombamento</button>
    <button type="submit" name="processar_processado" class="btn btn-success" value="Processado" onclick="return confirm('Mudar status para Processado?')">Processar</button>
    </div>
</form>