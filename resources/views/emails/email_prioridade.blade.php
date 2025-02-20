@foreach($itens as $item)
    
@php
    $codpes = \Uspdev\Replicado\Pessoa::obterCodpesPorEmail($item->pedido_usuario);
@endphp

<p>
    O item de título "<b>{{$item->titulo ?? ''}}</b>" e tombo "<b>{{$item->tombo ?? ''}}</b>" teve um pedido de prioridade no processamento feito por {{\Uspdev\Replicado\Pessoa::dump($codpes)['nompes']}} - {{\Uspdev\Replicado\Pessoa::email($codpes)}}, {{$codpes}} em {{ date("d/m/Y", strtotime( '-1 days' ) ) }}
</p>
<br/>
@endforeach
    
Aceite em: <a href="https://gembib.fflch.usp.br/prioridades" target="_blank">https://gembib.fflch.usp.br/prioridades</a>
<br /> <br /> <br />
E-Mail automático. Não responder.