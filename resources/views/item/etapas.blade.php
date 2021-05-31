@section('styles')
  @parent
  <link rel="stylesheet" type="text/css" href="{{asset('/css/stepper.css')}}">
@endsection('styles')

<div class="md-stepper-horizontal orange">

    @foreach ($item::status as $status)
      <div class="md-step editable
        @if($item->status == $status) 
          active
        @else
          next
        @endif
      ">
        <a href="#">
          <div class="md-step-circle"><span></span></div>
          <div class="md-step-title">{{ $status }}</div>
          <div class="md-step-optional"></div>
        </a>
        <div class="md-step-bar-left"></div>
        <div class="md-step-bar-right"></div>
      </div>
    @endforeach
</div>
<div>
    @switch($item->status)
        @case('Sugestão')
            @include('item.etapas.sugestao')
        @break

        @case('Em Cotação')
            @include('item.etapas.cotacao')
        @break

        @case('Em Licitação')
            @include('item.etapas.licitacao')
        @break

        @case('Em Tombamento')
            @include('item.etapas.tombamento')
        @break

        @case('Tombado')
            @include('item.etapas.tombado')
        @break

        @case('Em Trânsito')
            @include('item.etapas.transito')
        @break

        @case('Em Processamento Técnico')
            @include('item.etapas.processamento')
        @break
        
        @case('Negado')
          @include('item.etapas.negado')
        @break
        
        @case('Processado')
          @include('item.etapas.processado')
        @break
        
        @case('Acervo')
          @include('item.etapas.acervo')
        @break

        @default
            <span>Erro no sistema, contate a Seção Técnica de Informática</span>
    @endswitch
</div>

<br>