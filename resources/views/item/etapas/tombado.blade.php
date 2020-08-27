<form method="POST" action="/processar_processamento/{{$item->id}}">
    @csrf 
    <div>
        <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
            <div class="form-group">
            <label for="observacao">Observações:</label>
            <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao') }}  @if(isset($item)){{ $item->observacao }} @endif</textarea>
            </div>
        <button type="submit" name="processar_processamento" class="btn btn-info" value="Em Processamento Técnico" onclick="return confirm('Mudar status para Em Processamento Técnico?')">Enviar para Processamento Técnico</button>
    </div>
</form>