<form method="POST" action="/processado/{{$item->id}}">
    @csrf 
    <div>
        <button type="submit" name="processado" class="btn btn-info" value="Processado">Processar</button>
    </div>
</form>