<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
        <button type="submit" name="processado" class="btn btn-info" value="Processado">Processar</button>
    </div>
</form>