{{ $registros->links() }}
<table class="table table-striped">
    <thead>
      <tr align="center">
        <th scope="col">Início</th>
        <th scope="col">Fim</th>
        <th scope="col">Títulos novos</th>
        <th scope="col">Volumes</th>
        <th scope="col">Consistência do Acervo</th>
        <th scope="col">Outro tipo de material:</th>
        <th scope="col">Multimeios:</th>
        <th scope="col">Serviços Técnicos</th>
        <th scope="col">Remoções do Acervo</th>
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
        <td> {{ $c->outro_material ?? '' }} </td>
        <td> {{ $c->multimeios ?? '' }} </td>
        <td> {{ $c->servicos_tecnicos ?? '' }} </td>
        <td> {{ $c->remocoes_acervo ?? '' }} </td>
        <td><a href="/" class="btn btn-success">Editar</a></td>  
      </tr>
    @endforeach
    </tbody>     
  </table>
