<table class="table table-striped">
  <thead>
  <tr align="center">
    <th scope="col"></th>
    <th scope="col">Títulos novos</th>
    <th scope="col">Volumes</th>
    <th scope="col">Consistência do Acervo</th>
    <th scope="col">Multimeios</th>
    <th scope="col">Serviços Técnicos</th>
    <th scope="col">Remoções do Acervo</th>
    <th scope="col">Outro tipo de material</th>
  </tr>
  </thead>
  <tbody>
    <tr align="center">
      <td><b>Soma:</b></td>
      <td>{{ $registros->sum('titulos_novos') }}</td>
      <td>{{ $registros->sum('volumes') }}</td>
      <td>{{ $registros->sum('consistencia_acervo') }}</td>
      <td>{{ $registros->sum('multimeios') }}</td>
      <td>{{ $registros->sum('servicos_tecnicos') }}</td>
      <td>{{ $registros->sum('remocoes_acervo') }}</td>
      <td>{{ $registros->sum('outro_material') }}</td>
    </tr>
  </tbody>
</table>