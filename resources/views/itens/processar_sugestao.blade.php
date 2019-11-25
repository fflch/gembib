@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
<!--mostrar o usuário que fez a sugestão; -->
<!--dar feedback e ter a info do e-mail para saber quem fez a sugestão (para perguntar se errou nos dados, informar que foi negado etc.); -->

<!--Função para abrir campo após seleção de outras verbas-->
<script type="text/javascript">
function mostraCampoStatus(obj) {
    var select = document.getElementById('status');
    var txt = document.getElementById("Outro");
    txt.style.visibility = (select.value == 'Outro') 
        ? "visible"
        : "hidden";  
  }
</script>
<!--fim da Função para abrir campo após seleção de outras verbas-->

<div>
  <b>Processamento do livro:</b> {{ $item->titulo }} <br>
  <b>Status:</b> {{ $item->status }} <br>
  <b>Autor:</b> {{ $item->autor }}<br>
  <b>Editora:</b> {{ $item->editora }}<br>
</div>
<br>

<form method="POST" action="/itens/store_processar_sugestao/{{$item->id}}">
    @csrf
    <div class="form-group">
        <label for="status">Mudança de status</label>
        <select class="form-control" id="status" name="status" onchange="mostraCampoStatus(this);">
          <option>Em processo de aquisição</option>
          <option>Negado</option>
          <option>Esgotado</option>
          <option>Em cotação</option>
          <option>Em licitação</option>
          <option>Outro</option>
        </select>

        <!--Função para abrir campo após seleção de outro status-->
        <input type="text" class="form-control" name="Outro" id="Outro" style="visibility: hidden;" placeholder="Informe outro status" >
        <!--fim da Função para abrir campo após seleção de outro status-->

    </div>

 <div class="form-group">
    <label for="motivo">Motivo caso for negado:</label>
    <textarea class="form-control" id="motivo" rows="3" name="motivo"></textarea>
  </div>
    <button type="submit" class="btn btn-success">Enviar</button>
  </div>

</form>

@endsection

