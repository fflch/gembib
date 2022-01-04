@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

@section('javascripts_bottom')
  <script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(document).ready(function(){
        $(".item").click(function () {
          if( $(this).val() )
          var item = $(this).val();
          {
            $.ajax({
              url:"{{ route('pedidos.item'," +item+ " ) }}",
              type: 'post',
              dataType: "json",
              data: {
                 _token: CSRF_TOKEN,
                 item: $(this).val(),
              },
            });
          }
        });
      });
  </script>
@endsection

<form method="GET">
<b>Insira as informações somente nos campos que achar necessário para sua busca:</b>
<br><br>
<div class="row">
  <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="titulo" value="{{ request()->titulo }}" placeholder="Busca por Título">
      </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="autor" value="{{ request()->autor }}" placeholder="Busca por Autor">
      </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="editora" value="{{ request()->editora }}" placeholder="Busca por Editora">
      </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
        <input type="text" name="ano" value="{{ request()->ano  }}" placeholder="Busca por Ano">
      </div>
    </div>
</div>
<button type="submit" class="btn btn-success">Buscar</button>
</form>
<br>

{{ $itens->appends(request()->query())->links() }}

<form method="POST" action="/pedido/email">
@csrf
  <div class="card">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Selecionar</th>
          <th scope="col">Título</th>
          <th scope="col">Autor</th>
          <th scope="col">Editora</th>
          <th scope="col">Ano</th>
        </tr>
      </thead>
      <tbody>
        @foreach($itens as $item)
        <tr>
          <td align="center"><input type="checkbox" class="item" name="item[]" value="{{ $item->id }}"
          @if(Session::has('itens')) @if(in_array( $item->id , Session::get('itens')))checked @endif) @endif></td>
          <td>{{ $item->titulo }}</td>
          <td>{{ $item->autor }}</td>
          <td>{{ $item->editora }}</td>
          <td>{{ $item->ano }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <br>
  <button type="submit" onclick="return confirm('Tem certeza que deseja solicitar esse(s) livro(s)');" class="btn btn-success" name="pedido">Realizar Pedido</button>
</form>
@endsection
