
@foreach($item as $i)

O item de título "<b>{{$i->titulo}}</b>" e tombo "<b>{{$i->tombo}}</b>" teve um pedido de prioridade no processamento feito por <b>{{$i->pedido_usuario}}</b>

<br />
@endforeach
<br/>

Aceite em: <a href="https://gembib.fflch.usp.br/prioridades" target="_blank">https://gembib.fflch.usp.br/prioridades</a>
<br /> <br /> <br />
E-Mail automático. Não responder.