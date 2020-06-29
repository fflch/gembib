<form method="POST" action="/processar_tombamento/{{$item->id}}">
    @csrf 
    <div>
        <button type="submit" name="processar_tombamento" class="btn btn-info" value="Tombado">Tombar</button>
    </div>
</form>