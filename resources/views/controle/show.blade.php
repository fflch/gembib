<form method="GET">
  <div class="row">
      <div class="col-sm form-group">
          <b>Busca por período:</b>
          <input name="busca_inicio" data-mask="00/00/0000" class="datepicker" value="{{ Request()->busca_inicio }}" autocomplete="off"> <b>-</b>
          <input name="busca_fim" data-mask="00/00/0000" class="datepicker" value="{{ Request()->busca_fim }}" autocomplete="off">
          <button type="submit" class="btn btn-success btn-sm">Buscar</button>
          <a href="/controle/pdf?busca_inicio={{Request()->busca_inicio}}
            &busca_fim={{Request()->busca_fim}}" style="float: right;">
          <i class="fas fa-file-pdf"></i> Exportar busca em PDF</a> 
      </div>
  </div>
</form>

{{ $registros->appends(request()->query())->links() }}
@include('controle.partials.quantidades')

<table class="table table-striped">
    <thead>
      <tr align="center">
        <th scope="col">Início</th>
        <th scope="col">Fim</th>
        <th scope="col">Títulos novos</th>
        <th scope="col">Volumes</th>
        <th scope="col">Consistência do Acervo</th>
        <th scope="col">Multimeios</th>
        <th scope="col">Serviços Técnicos</th>
        <th scope="col">Remoções do Acervo</th>
        <th scope="col">Outro tipo de material</th>
        <th scope="col">Ações</th>
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
        <td><a href="/controle/{{$c->id}}/edit" class="btn btn-success w-100" onclick="">Ver</a>
          <form method="POST" action="/controle/{{$c->id}}/destroy"> 
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Tem certeza que deseja excluir?');"> Excluir </button>  
          </form>
        </td>  

      </tr>
    @endforeach
    </tbody>     
  </table>
