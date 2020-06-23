<form method="POST" action="/processar_sugestao/{{$item->id}}">
    @csrf 
    <button type="submit" name="processar_sugestao" class="btn btn-info" value="Em Tombamento">Começar Tombamento</button>
    <button type="submit" name="processar_sugestao" class="btn btn-info" value="Em Cotação">Em Cotação</button>


    <br><br>
    <div class="form-group">
        <label for="motivo">Justificativa para Negar</label>
        <textarea class="form-control" id="motivo" rows="3" name="motivo">@if(isset($item)){{ $item->motivo }}
  @endif</textarea>
    </div>

    <button type="submit" name="processar_sugestao" class="btn btn-danger" value="Negado">Negar</button>
</form>

