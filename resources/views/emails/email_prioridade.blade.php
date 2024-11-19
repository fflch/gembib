@foreach($itens as $item)
O item de título "<b>{{$item->titulo}}</b>" e tombo "<b>{{$item->tombo}}</b>" teve um pedido de prioridade no processamento feito por <b>{{$item->pedido_usuario}}</b>
<br />
@endforeach
<br/>

Aceite em: <a href="https://gembib.fflch.usp.br/prioridades" target="_blank">https://gembib.fflch.usp.br/prioridades</a>
<br /> <br /> <br />
E-Mail automático. Não responder.
