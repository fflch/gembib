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

<div>
  <h3><center>{{ $titulo }}</center></h3>
</div>

<table style='width:100%'>
  <thead>
    <tr>
      <th>Tombo:</th>
      <th>Autor:</th>
      <th>Título:</th>
      <th>Volume:</th>
      <th>Parte:</th>
      <th>Preço:</th>
    </tr>
  </thead>
  
  <tbody>
  	@foreach($itens as $item) 
    <tr>
      <td><center>{{$item->tombo}}</td>
      <td><center>{{$item->autor}}</td>
      <td><center>{{$item->titulo}}</td>
      <td><center>{{$item->volume}}</td>
      <td><center>{{$item->parte}}</td>
      <td><center>{{ $item->preco }}</td>
    </tr>
    @endforeach

  </tbody>
</table>

<div>
<br>
<div>
<label><b>Quantidade: {{$itens->count()}} </b></label>
</div>
  <div style='width: 75%'>
</div>
<br>
<div>
<label><b>Total: R${{ $total }}</b></label>
</div>
</div>


