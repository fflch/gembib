@foreach($itens as $item)

<p>O item de título <b>{{ $item['titulo'] ?? 'Sem título' }}</b> - <b>{{ $item['tombo'] ?? 'Sem tombo' }}</b> teve um pedido de prioridade feito por <b>{{ $item['name'] }}, {{ $item['codpes'] }} - {{$item['pedido_usuario']}}</b> em {{ date("d/m/Y", strtotime( '-1 days' ) ) }}<br />
</p>
@endforeach

Veja-os em: <a href="https://gembib.fflch.usp.br/prioridades" target="_blank">https://gembib.fflch.usp.br/prioridades</a>
<br /> <br /> <br />
E-Mail automático. Não responder.
