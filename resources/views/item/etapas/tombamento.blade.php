<form method="POST" action="/processar_tombamento/{{$item->id}}">
    @csrf
    @if(isset($item->tombo))
    <div>
        <p>Material devolvido pelo Processamento Técnico para revisão por {{ $item->alterado_por }}.</p>
        @include('item.observacao')
        <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
        <button type="submit" name="processar_tombamento" class="btn btn-success" value="Em Processamento Técnico" onclick="return confirm('Mudar status para Em Processamento Técnico?')">Devolver para Processamento Técnico</button> 
    </div>
    @else 
    <div>
        <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
        @include('item.observacao')
        <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
        <button type="submit" name="processar_tombamento" class="btn btn-success" value="tombar" onclick="return confirm('Mudar status para Tombado?')">Tombar (gerar número de tombo)</button>
    </div>
    @endif
    <br>
    @include('item/form')
    <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
        <button type="submit" name="processar_tombamento" class="btn btn-success" value="tombar" onclick="return confirm('Mudar status para Tombado?')">Tombar (gerar número de tombo)</button>
</form>