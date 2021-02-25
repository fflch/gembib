<script src="/js/item.js"></script>
<form method="POST" action="/processar_processado/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{ $item->status }} por {{ $item->alterado_por }} em {{ $item->data_processamento }}.</p>
    <p>Última alteração feita em: {{ $item->updated_at }}<br>
    @include('item.observacao')


    <label for="bibliotecario">Recebimento do livro processado pelo STL para SAU:</label>

    <select class="form-control" id="bibliotecario" name="bibliotecario">
        <option value="">Selecionar bibliotecário SAU que irá receber</option>
        @foreach ($item->sau as $s)
        <option value="{{$s}}"> 
            {{ Uspdev\Replicado\Pessoa::nomeCompleto($s) }}
        </option>
        @endforeach
    </select>
<br>
    <button type="submit" name="processar_processado" class="btn btn-info" value="Em Trânsito" onclick="return confirm('Mudar status para Em Tombamento? O livro entrará Em Trânsito.')">Devolver para Tombamento</button>
    <button type="submit" name="processar_processado" class="btn btn-success" value="Processado" onclick="return confirm('Mudar status para Processado?')">Processar</button>
    </div>
</form>