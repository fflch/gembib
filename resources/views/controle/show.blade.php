<form method="GET">
  @csrf
  <div class="row">
      <div class="col-sm form-group">
          <b>Busca por período:</b>
          <input type="text" name="busca_inicio" class="datepicker" value="{{ Request()->busca_inicio }}"> <b>-</b>
          <input type="text" name="busca_fim" class="datepicker" value="{{ Request()->busca_fim }}">
          <button type="submit" class="btn btn-success btn-sm">Buscar</button>
      </div>
  </div>
</form>

<table class="table table-striped">
    <thead>
      <tr align="center">
        <th scope="col">Início</th>
        <th scope="col">Fim</th>
        <th scope="col">Títulos novos</th>
        <th scope="col">Volumes</th>
        <th scope="col">Consistência do Acervo</th>
        <th scope="col">Multimeios:</th>
        <th scope="col">Serviços Técnicos</th>
        <th scope="col">Remoções do Acervo</th>
        <th scope="col">Outro tipo de material:</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>
    @foreach($registros as $c) 
      <tr align="center">
        <td> {{ $c->inicio ?? '' }} </td>
        <td> {{ $c->fim ?? '' }} </td>
        <td> {{ $c->titulos_novos ?? '' }} </td>
        <td> {{ $c->volumes ?? '' }} </td>
        <td> {{ $c->consistencia_acervo ?? '' }} </td>
        <td> {{ $c->multimeios ?? '' }} </td>
        <td> {{ $c->servicos_tecnicos ?? '' }} </td>
        <td> {{ $c->remocoes_acervo ?? '' }} </td>
        <td> {{ $c->outro_material ?? '' }} </td>
        <td><a href="/controle/{{$c->id}}/edit" class="btn btn-success" onclick="return confirm('Deseja editar esse registro?');">Editar</a></td>  
      </tr>
    @endforeach
    </tbody>     
  </table>
{{ $registros->appends(request()->query())->links() }}