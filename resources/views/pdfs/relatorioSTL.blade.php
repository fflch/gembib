<table style='width:100%'>
  <tr>
    <td style='width:20%' style='text-align:left;'>
      <img src='./images/logo.png' width='230px'/>
    </td>
    <td style='width:80%'; style='text-align:center;'>
      <p align='center'><b>SERVIÇO DE BIBLIOTECA E DOCUMENTAÇÃO</b><br>
       FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS - USP<br>
       Av.: Prof. Lineu Prestes - travessa 12. n° 350 CEP: 05508-900 - Cidade Universitária - São Paulo - SP / Brasil<br>
       Serviço de Processamento Técnico (11)3091-4818 - stlfflch@usp.br</p>
    </td>
  </tr>
</table>

<div>
  <h3><center>{{ $titulo  ?? '' }}</center></h3>
</div>

<table style='width:80%'>
  <thead>
    <tr>
      <th>Tombo:</th>
      <th>Autor:</th>
      <th>Título:</th>
      <th>Status:</th>
      <th>Data de de Envio para Processamento Técnico:</th>
      <th>Data de Finalização do Processamento Técnico:</th>
    </tr>
  </thead>

  <tbody>
  	@foreach($itens as $item)
    <tr>
      <td><center>{{$item->tombo}}</td>
      <td>{{$item->autor}}</td>
      <td>{{$item->titulo}}</td>
      <td>{{$item->status}}</td>
      <td>{{$item->data_processamento}}</td>
      <td>{{$item->data_processado}}</td>
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
</div>


