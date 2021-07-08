<table style='width:100%'>
  <tr>
    <td style='width:20%' style='text-align:left;'>
      <img src='./images/logo.png' width='230px'/>
    </td>
    <td style='width:80%'; style='text-align:center;'>
      <p align='center'><b>SERVIÇO DE BIBLIOTECA E DOCUMENTAÇÃO</b><br>
       FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS - USP<br>
       Av.: Prof. Lineu Prestes - travessa 12. n° 350 CEP: 05508-900 - Cidade Universitária - São Paulo - SP / Brasil<br>
       Serviço de Aquisição e Intercâmbio (11)3091-4502 - saifflch@usp.br</p>
    </td>
  </tr>
</table>

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
    </tr>
  @endforeach
  </tbody>     
</table>
