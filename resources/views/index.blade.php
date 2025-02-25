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
<div class="alert alert-info" id="info" style="display:block;">Para solicitar um processamento de um livro, selecione o item desejado na <b>checkbox</b> à direita.</div>
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
        <input class="checkbox-prioridade" type="checkbox" name="prioridade[]" value="{{ $item->id }}" id="item_{{$item->id}}" {{ in_array($item->id, $selecionados) ? 'checked' : '' }}>
        <label for="item_{{$item->id}}">Selecionar item</label>
      </td>
      @else
      <td><p class="text-info" style="margin:2px;">Prioridade pedida</p></td>
      @endif
    </tr>
    @endforeach    
  </tbody>
</table>
  <button type="submit" class="btn btn-primary" style="margin:10px; visibility:hidden;" id="submit">
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

  let checkboxes = document.getElementsByClassName('checkbox-prioridade');
  let button = document.getElementById('submit');
  let checkboxesSelecionadas = Array.from(document.querySelectorAll('input[name="prioridade[]"]:checked')).map(el => el.value);

  function hideBtn(){
    fetch("{{route('index') }}", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
      })

    .then(response => response.json())
    .then(data => {
      checkboxesSelecionadas.forEach(e => {
        button.style = 'visibility: visible; margin: 10px;';
      });
      //for(let o = 0; o < checkboxesSelecionadas.length; o++){
      //  button.style = 'visibility: visible; margin: 10px';
      //}
    })
    .catch(error => console.error(error))
//verificar a lógica do loop abaixo. (Apagar para testar)
    for(let i = 0; i < checkboxes.length ; i++){
      checkboxes[i].addEventListener('click', function(){
        if(checkboxesSelecionadas && checkboxes[i].checked){
          button.style = "visibility: visible; margin: 10px;";
        }else{
          button.style = "visibility: hidden; margin: 10px";
        }
      });
    }
  }
    hideBtn();

  document.querySelectorAll('.checkbox-prioridade').forEach(checkbox => {
    checkbox.addEventListener("change", function () {
        let allPageCheckboxes = Array.from(document.querySelectorAll('input[name="prioridade[]"]')).map(el => el.value);
        let teste = document.getElementById('info');
        // Lista de apenas os checkboxes marcados na página atual
        let selecionadosNaPagina = [];
        document.querySelectorAll('input[name="prioridade[]"]:checked').forEach(el => {
            selecionadosNaPagina.push(el.value);
        });

        // Envia para o backend tanto os IDs da página atual quanto os selecionados
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
            selecionadosNaPagina.forEach(e => {
              if(selecionadosNaPagina)
              teste.style = "display:none";
            });
        })
        //.then(data => console.log("Sessão atualizada:", data))
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
