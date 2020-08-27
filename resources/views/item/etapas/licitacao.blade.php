<form method="POST" action="/processar_licitacao/{{$item->id}}">
@csrf 
<div>
    <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
        <div class="form-group">
        <label for="observacao">Observações:</label>
        <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao') }}  @if(isset($item)){{ $item->observacao }}@endif</textarea>
        </div>
    <button type="submit" name="processar_licitacao" class="btn btn-info" value="Em Tombamento" onclick="return confirm('Mudar status para Em Tombamento?')">Começar Tombamento</button>
</div>
</form>