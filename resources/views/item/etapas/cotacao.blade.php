<form method="POST" action="/processar_cotacao/{{$item->id}}">
  @csrf 
  <div>
    <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
      <div class="form-group">
      <label for="observacao">Observações:</label>
      <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao') }}  @if(isset($item)){{ $item->observacao }}@endif</textarea>
      </div>
    <button type="submit" class="btn btn-info" name="processar_cotacao" value="Em Licitação" onclick="return confirm('Mudar status para Em Licitação?')">Em Licitação</button>
    <br><br>
      <div class="form-group">
        <label for="motivo">Justificativa para negar:</label>
        <textarea class="form-control" id="motivo" rows="1" name="motivo">@if(isset($item)){{ $item->motivo }}
        @endif</textarea>
      </div>
        <button type="submit" name="processar_cotacao" class="btn btn-danger" value="Negado">Negar</button>
  </div> 
</form>