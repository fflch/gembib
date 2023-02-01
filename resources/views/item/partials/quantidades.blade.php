<div class="card">
  <table class="table table-striped">
    <thead>
    <tr align="center">
      <th scope="col">Sugestão</th>
      <th scope="col">Em Cotação:</th>
      <th scope="col">Negado:</th>
      <th scope="col">Em Licitação:</th>
      <th scope="col">Em Tombamento:</th>
      <th scope="col">Tombado:</th>
      <th scope="col">Em Processamento Técnico:</th>
      <th scope="col">Processado:</th>
      <th scope="col">Total de itens:</th>
    </tr>
    </thead>
    <tbody>
      <tr align="center">
        <td>{{ $quantidades['sugestao'] }}</td>
        <td>{{ $quantidades['cotacao'] }}</td>
        <td>{{ $quantidades['negado'] }}</td>
        <td>{{ $quantidades['licitacao'] }}</td>
        <td>{{ $quantidades['tombamento'] }}</td>
        <td>{{ $quantidades['tombado'] }}</td>
        <td>{{ $quantidades['processamento'] }}</td>
        <td>{{ $quantidades['processado'] }}</td>
        <td>{{ $query->total() }}</td>
      </tr>
    </tbody>
  </table>
</div>