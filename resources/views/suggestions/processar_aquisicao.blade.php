@extends('laravel-usp-theme::master')

@section('content')


<div>
  <b>Id:</b> {{ $acquisition->id }}<br>
</div>
<br>

<form method="POST" action="/suggestions/store_processar_aquisicao/{{$acquisition->id}}">
    @csrf

    <div class="form-group">
      <label for="tombo">Tombo:</label>
      <input type="text" id="tombo" name="tombo">
    </div>

    <div class="form-group">
      <label for="tombo_antigo">Tombo antigo:</label>
      <input type="text" id="tombo_antigo" name="tombo_antigo">
    </div>

    <div class="form-group">
      <label for="cod_impressao">Código de impressão:</label>
      <input type="text" id="cod_impressao" name="cod_impressao">
    </div>

    <div class="form-group">
      <label for="ordem_relatorio">Ordem no relatório:</label>
      <input type="text" id="ordem_relatorio" name="ordem_relatorio">
    </div>

    <div class="form-group">
        <label for="tipo_aquisicao">Tipo de aquisição:</label>
        <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
          <option>Aquisicao1</option>
          <option>Aquisicao2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tipo_material">Tipo de material:</label>
        <select class="form-control" id="tipo_material" name="tipo_material">
          <option>Material1</option>
          <option>Material2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="subcategoria">Subcategoria:</label>
        <select class="form-control" id="subcategoria" name="subcategoria">
          <option>Subcategoria1</option>
          <option>Subcategoria2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="capes">Capes:</label>
        <select class="form-control" id="capes" name="capes">
          <option>Capes1</option>
          <option>Capes2</option>
        </select>
    </div>

    <br><h3>IDENTIFICAÇÃO</h3><br>

    <div class="form-group">
      <label for="id_material">id_material:</label>
      <input type="text" id="id_material" name="id_material">
    </div>

    <div class="form-group">
      <label for="id_sugestao">id_sugestao:</label>
      <input type="text" id="id_sugestao" name="id_sugestao">
    </div>

    <div class="form-group">
      <label for="UsuarioS">UsuarioS:</label>
      <input type="text" id="UsuarioS" name="UsuarioS">
    </div>

    <div class="form-group">
      <label for="UsuarioA">UsuarioA:</label>
      <input type="text" id="UsuarioA" name="UsuarioA">
    </div>

    <br><h3>LIVRO</h3><br>

    <div class="form-group">
      <label for="autor">Autor:</label>
      <input type="text" id="autor" name="autor" value="{{ $acquisition->autor }}">
    </div>

    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" value="{{ $acquisition->titulo }}">
    </div>

    <div class="form-group">
      <label for="link">Link:</label>
      <input type="text" id="link" name="link">
    </div>

    <div class="form-group">
      <label for="edicao">Edição:</label>
      <input type="text" id="edicao" name="edicao">
    </div>
    
    <div class="form-group">
      <label for="volume">Volume:</label>
      <input type="text" id="volume" name="volume">
    
    </div>
    <div class="form-group">
      <label for="parte">Parte:</label>
      <input type="text" id="parte" name="parte">
    </div>

    <div class="form-group">
      <label for="fasciculo">Fascículo:</label>
      <input type="text" id="fasciculo" name="fasciculo">
    </div>

    <div class="form-group">
      <label for="local">Local:</label>
      <input type="text" id="local" name="local">
    </div>

    <div class="form-group">
      <label for="editora">Editora:</label>
      <input type="text" id="editora" name="editora" value="{{ $acquisition->editora }}">
    </div>

    <div class="form-group">
      <label for="ano">Ano:</label>
      <input type="text" id="ano" name="ano">
    </div>

    <div class="form-group">
      <label for="colecao">Coleção:</label>
      <input type="text" id="colecao" name="colecao">
    </div>

    <div class="form-group">
      <label for="isbn">ISBN:</label>
      <input type="text" id="isbn" name="isbn">
    </div>

    <div class="form-group">
      <label for="escala">Escala:</label>
      <input type="text" id="escala" name="escala">
    </div>

    <br><h3>OUTRAS INFORMAÇÕES</h3><br>

    <div class="form-group">
        <label for="departamento">Departamento:</label>
        <select class="form-control" id="departamento" name="departamento">
          <option>Dpto1</option>
          <option>Dpto2</option>
        </select>
    </div>

    <div class="form-group">
      <label for="pedido_por">Pedido por:</label>
      <input type="text" id="pedido_por" name="pedido_por">
    </div>

    <div class="form-group">
      <label for="finalidade">Finalidade:</label>
      <input type="text" id="finalidade" name="finalidade">
    </div>

    <div class="form-group">
      <label for="data_pedido">Data do pedido:</label>
      <input type="text" id="data_pedido" name="data_pedido">
    </div>

    <div class="form-group">
        <label for="prioridade">Prioridade:</label>
        <select class="form-control" id="prioridade" name="prioridade" value="">
          <option>Prioridade1</option>
          <option>Prioridade2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
          <option>Status1</option>
          <option>Status2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="moeda">Moeda:</label>
        <select class="form-control" id="moeda" name="moeda">
          <option>Moeda1</option>
          <option>Moeda2</option>
        </select>
    </div>


    <div class="form-group">
      <label for="preco">Preço:</label>
      <input type="text" id="preco" name="preco">
    </div>

    <div class="form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option>Procedencia1</option>
          <option>Procedencia2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="observacao">Observação:</label>
        <textarea class="form-control" id="observacao" rows="3" name="observacao"></textarea>
    </div>

    <br><h3>INFORMAÇÕES FINANCEIRAS????</h3><br>

    <div class="form-group">
        <label for="verba">Verba:</label>
        <select class="form-control" id="verba" name="verba">
          <option>Verba1</option>
          <option>Verba2</option>
        </select>
    </div>

    <div class="form-group">
      <label for="processo">Processo:</label>
      <input type="text" id="processo" name="processo">
    </div>

    <div class="form-group">
      <label for="fornecedor">Fornecedor:</label>
      <input type="text" id="fornecedor" name="fornecedor">
    </div>

    <div class="form-group">
      <label for="nota_fiscal">Nota fiscal:</label>
      <input type="text" id="nota_fiscal" name="nota_fiscal">
    </div>

    <div class="form-group">
      <label for="pasta">Pasta:</label>
      <input type="text" id="pasta" name="pasta">
    </div>

    <div class="form-group">
        <label for="moeda_nf">Moeda:</label>
        <select class="form-control" id="moeda_nf" name="moeda_nf">
          <option>Moeda1</option>
          <option>Moeda2</option>
        </select>
    </div>

    <div class="form-group">
      <label for="preco_nf">Preço:</label>
      <input type="text" id="preco_nf" name="preco_nf">
    </div>

    <div class="form-group">
      <label for="">Data:</label>
      <input type="text" id="data_nf" name="data_nf">
    </div>


    <div>
      <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>

</form>

@endsection