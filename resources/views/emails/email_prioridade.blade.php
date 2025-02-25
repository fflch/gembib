O usuário {{ $user->name }} ({{ $user->email }}/NUSP {{ $user->codpes }}), em {{ date("d/m/Y", strtotime( '-1 days' ) ) }} solicitou prioridade de processamento no(s) título(s) abaixo:
<br />
<b>Tombo - Título</b>
<p>
@foreach($itens as $item)
{{ $item->tombo ?? 'Sem tombo' }} - {{ $item->titulo ?? 'Sem título' }} <br />
@endforeach
</p>

Veja-os em: <a href="https://gembib.fflch.usp.br/prioridades" target="_blank">https://gembib.fflch.usp.br/prioridades</a>
<br /> <br /> <br />
E-Mail automático. Não responder.
