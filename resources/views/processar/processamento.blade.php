<form method="POST" action="/processamento/{{$item->id}}">
    @csrf 
    <div>
        <button type="submit" name="processamento" class="btn btn-info" value="Em Processamento Técnico">Começar Processamento Técnico</button>
    </div>
</form>