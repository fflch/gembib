@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<h3>Sistema para Gestão de Material Bibliográfico</h3>

Consulte nosso acervo público na busca abaixo:
<br><br>

<form method="get">
<div class="row">
    <div class=" col-sm input-group">
    <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="Buscar por título, autor, tombo ou código de impressão">

    <span class="input-group-btn">
        <button type="submit" class="btn btn-success"> Buscar </button>
    </span>

    </div>
</div>
</form><br>

Para fazer sugestões de compra, acesse o sistema com sua <a href="{{ route('login') }}">Senha Única</a> da Universidade de São Paulo.

@if($itens && $itens->count() > 0)
{{ $itens->appends(request()->query())->links() }}
<div class="alert alert-info" id="info" style="display:block;">Para solicitar uma prioridade no processamento de um livro, click no botão <b>Solicitar</b> à direita.</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Tombo</th>
      <th scope="col">Título</th>
      <th scope="col">Autor</th>
      <th scope="col">Prioridade</th>
    </tr>
  </thead>

  <tbody>
    @foreach($itens as $item)
    <tr>
      <td>{{ $item->status }}</td>
      <td>{{ $item->tombo ?? 'Sem tombo' }}</td>
      <th>
        @can("ambos")
        <a href="/item/{{$item->id}}">
        @endcan
        {{ $item->titulo }}
      </th>
      <td>{{ $item->autor }}</td>
      <td>
        @can('logado')
        <button
          type="button"
          name="prioridade"
          data-id="{{ $item->id }}"
          class="btn {{ $item->prioridade_processamento ? 'btn-secondary' : 'btn-primary' }}"
          @disabled($item->prioridade_processamento)>
          {{ $item->prioridade_processamento ? 'Solicitado' : 'Solicitar' }}
        </button>
        @endcan
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@if($request->search && $itens->count() == 0)
<div class="alert alert-info">A busca não retornou resultados</div>
@endif

@if($itens)
{{ $itens->appends(request()->query())->links() }}
@endif
@endsection('content')

@section('javascripts_bottom')
  <script>
    $(document).ready(function(){

      $(".btn-primary").on("click", function(e) {
        e.preventDefault();
        let button = $(this);
        let email = "{{ Auth::user()->email }}";

        $.ajax({
          url:"{{ route('salvarPrioridade') }}",
          type: "POST",
          dataType: "json",
          data: {
            _token: "{{ csrf_token() }}",
            item: $(this).data("id"),
            email: email
          },
          success: function(data) {
            button.text("Solicitado").removeClass("btn-primary").addClass("btn-secondary");
            button.prop("disabled", true);
          },
          error: function() {
            button.text("Solicitar").removeClass("btn-secondary").addClass("btn-primary");
            alert("Algo deu errado!");
          },
        });
      });

    });
  </script>
@endsection
