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
      <td>{{ $quantidades['titulos_novos'] }}</td>
      <td>{{ $quantidades['volumes'] }}</td>
      <td>{{ $quantidades['consistencia_acervo'] }}</td>
      <td>{{ $quantidades['multimeios'] }}</td>
      <td>{{ $quantidades['servicos_tecnicos'] }}</td>
      <td>{{ $quantidades['remocoes_acervo'] }}</td>
      <td>{{ $quantidades['outro_material'] }}</td>
    </tr>
  </tbody>
</table>