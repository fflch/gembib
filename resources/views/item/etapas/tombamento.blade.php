<form method="POST" action="/processar_tombamento/{{$item->id}}">
    @csrf 
    <div>
        <p>Enviado para {{$item->status}} por {{$item->alterado_por}}</p>
        <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
        <button type="submit" name="processar_tombamento" class="btn btn-success" value="tombar" onclick="return confirm('Mudar status para Tombado?')">Tombar (gerar número de tombo)</button>
    </div>
    <br>
    @include('item/form')
    <div>
    <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
    <button type="submit" name="processar_tombamento" class="btn btn-success" value="tombar" onclick="return confirm('Mudar status para Tombado?')">Tombar (gerar número de tombo)</button>
    </div>
</form>