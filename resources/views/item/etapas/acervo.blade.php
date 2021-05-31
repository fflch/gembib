<form method="POST" action="/processar_acervo/{{$item->id}}">
    @csrf 
    <div>
    <p>Enviado para {{ $item->status }} 
        @include('item.partials.alterado_por')
        @if($item->data_processado) 
            em {{ $item->data_processado }}.
        @endif
    </p> 
    @if($item->recebido_sau_por)
        <p>Entregue para bibliotecário(a) SAU: {{ Uspdev\Replicado\Pessoa::nomeCompleto($item->recebido_sau_por) }}.
    @endif
    <p>Última alteração feita em: {{ $item->updated_at }}</p>

    <label for="bibliotecario">Recebimento do livro processado pelo STL para SAU:</label>

    <select class="form-control" id="bibliotecario" name="bibliotecario">
        <option value="">Selecionar bibliotecário SAU que irá receber</option>
        @foreach ($item->sau as $s)
        {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
        @if (old('bibliotecario') == '' and isset($item->recebido_sau_por))
            <option value="{{$s}}" {{ ( $item->recebido_sau_por == $s) ? 'selected' : ''}}>
                {{ Uspdev\Replicado\Pessoa::nomeCompleto($s) }}
            </option>
        {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
        @else
            <option value="{{$s}}" {{ ( old('bibliotecario') == $s) ? 'selected' : ''}}>
                {{ Uspdev\Replicado\Pessoa::nomeCompleto($s) }}
            </option>
            @endif
        @endforeach
    </select><br>    
        
        <div>
        <button type="submit" name="processar_acervo" class="btn btn-success" value="Salvar" onclick="return confirm('Alterar funcionário?')">Salvar</button>
        </div> 
    </div>
</form>