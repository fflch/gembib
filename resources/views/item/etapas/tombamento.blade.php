<form method="POST" action="/processar_tombamento/{{$item->id}}">
    @csrf 
    <div>
        <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
        <button type="submit" name="processar_tombamento" class="btn btn-success" value="tombar">Tombar (gerar número de tombo)</button>
    </div>
    <br>
    @include('item/form')
    <div>
    <button type="submit" name="processar_tombamento" class="btn btn-info" value="salvar">Salvar e continuar editando</button>
    <button type="submit" name="processar_tombamento" class="btn btn-success" value="tombar">Tombar (gerar número de tombo)</button>
    </div>
</form>