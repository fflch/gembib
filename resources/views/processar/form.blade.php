@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
<!--mostrar o usuário que fez a sugestão; -->
<!--dar feedback e ter a info do e-mail para saber quem fez a sugestão (para perguntar se errou nos dados, informar que foi negado etc.); -->

<!--Função para abrir campo após seleção de outros status-->
<!--fim da Função para abrir campo após seleção de outros status-->




<br>

<form method="POST" action="/itens/store_processar_sugestao/{{$item->id}}">
    @csrf
    <div class="form-group">
        <label for="status">Mudança de status</label>
        <select class="form-control" id="status" name="status" onchange="mostraCampoStatus(this);">
          @foreach($status as $s)
            <option>{{ $s }}</option>
          @endforeach
        </select>

        <!--Função para abrir campo após seleção de outro status-->
        <input type="text" class="form-control" name="outroStatus" id="Outro" style="visibility: hidden;" placeholder="Informe outro status" >
        <!--fim da Função para abrir campo após seleção de outro status-->

    </div>

<div class="form-group">
    <label for="motivo">Motivo caso for negado:</label>
    <textarea class="form-control" id="motivo" rows="3" name="motivo"></textarea>
</div>

    @include('item/form')

  </div>
    <button type="submit" class="btn btn-success">Enviar</button>
  </div>


</form>

@endsection

