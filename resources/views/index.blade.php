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
<div class="alert alert-info" id="info" style="display:block;">Para solicitar uma prioridade no processamento de um livro, selecione o item desejado na <b>checkbox</b> à direita.</div>
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
    <form method="post" action="/pedido-prioridade">
      @csrf
      @method('PUT')
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
      @if(!$item->prioridade_processamento)
      <td>
        @php

        $selecionados = session()->get('prioridadesSelecionadas',[]);

        @endphp
        <input class="checkbox-prioridade" type="checkbox" name="prioridade[]" value="{{ $item->id }}" id="item_{{$item->id}}" style="width:17px; height:17px;" {{ in_array($item->id, $selecionados) ? 'checked' : '' }}>
        <label for="item_{{$item->id}}">Selecionar item</label>
      </td>
      @else
      <td><p class="text-info" style="margin:2px;">Prioridade pedida</p></td>
      @endif
    </tr>
    @endforeach    
  </tbody>
</table>
  <button type="submit" class="btn btn-primary" style="margin:10px; display:none;" id="submit">
    Pedir prioridade
  </button>
</form>
  @endif
@if($request->search && $itens->count() == 0)
<div class="alert alert-info">A busca não retornou resultados</div>
@endif

@if($itens)
{{ $itens->appends(request()->query())->links() }}
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {

  let checkboxes = document.querySelectorAll('input[name="prioridade[]"]');
  let button = document.getElementById('submit');
  let info = document.getElementById('info');
  function atualizarVisibilidadeBotao() {
    fetch("{{ route('index') }}")
    .then(response => response.json())
    .then(data => {
        checkboxes.forEach(checkbox => {
          if (data.includes(checkbox.value)) {
            checkbox.checked = true;
          } else {
            checkbox.checked = false;
          }
        });

        // Se houver pelo menos um item selecionado, exibe o botão
        if (data.length > 0) {
          button.style.display = "flex";
          info.style.display = 'none';
        } else {
          info.style.display = 'block';
          button.style.display = "none";
        }
      })
      .catch(error => console.error("Erro ao buscar seleções:", error));
  }

  // Chama a função ao carregar a página para definir a visibilidade do botão
  atualizarVisibilidadeBotao();

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener("change", function () {
      let selecionadosNaPagina = Array.from(document.querySelectorAll('input[name="prioridade[]"]:checked')).map(el => el.value);
      let allPageCheckboxes = Array.from(document.querySelectorAll('input[name="prioridade[]"]')).map(el => el.value);

        fetch("{{ route('salvarPrioridades') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ 
                page_ids: allPageCheckboxes, 
                selected_ids: selecionadosNaPagina 
            })
        })
      .then(response => response.json())
      .then(data => {
        // Após atualizar a sessão, atualiza também a visibilidade do botão
        atualizarVisibilidadeBotao();
      })
        .catch(error => console.error("Erro ao atualizar a sessão:", error));
    });
});

    // Atualizar os itens no banco ao clicar no botão de envio
    document.getElementById("submit").addEventListener("click", function () {
        fetch("{{ route('pedidoPrioridade') }}", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                window.location.reload(); // Recarregar para refletir as atualizações
            }
        })
        .catch(error => console.error("Erro ao atualizar:", error));
    });
});
</script>

@endsection('content')
