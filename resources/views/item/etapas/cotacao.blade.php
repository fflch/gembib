<form method="POST" action="/processar_cotacao/{{$item->id}}">
  @csrf
  <div>
    <p>Enviado para {{$item->status}}
    @include('item.partials.alterado_por')
    em {{$item->updated_at}}.
    </p>
    @include('item.observacao') 
    <button type="submit" class="btn btn-info" name="processar_cotacao" value="Em Licitação" onclick="return confirm('Mudar status para Em Licitação?')">Em Licitação</button>
    <br><br>
      <div class="form-group">
        <label for="motivo">Justificativa para negar:</label>
        <textarea class="form-control" id="motivo" rows="2" name="motivo">@if(isset($item)){{ $item->motivo }}
        @endif</textarea>
      </div>
        <button type="submit" name="processar_cotacao" class="btn btn-danger" value="Negado">Negar</button>
  </div> 
</form>