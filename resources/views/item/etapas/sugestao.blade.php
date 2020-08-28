<form method="POST" action="/processar_sugestao/{{$item->id}}">
    @csrf
    @include('item.observacao') 
    <button type="submit" name="processar_sugestao" class="btn btn-info" value="Em Cotação" onclick="return confirm('Mudar status para Em Cotação?')">Em Cotação</button>
    <button type="submit" name="processar_sugestao" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Começar Tombamento</button>
    <br><br>
    <div class="form-group">
        <label for="motivo">Justificativa para negar:</label>
        <textarea class="form-control" id="motivo" rows="1" name="motivo">@if(isset($item)){{ $item->motivo }}
  @endif</textarea>
    </div>

    <button type="submit" name="processar_sugestao" class="btn btn-danger" value="Negado">Negar</button>
</form>

