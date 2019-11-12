@extends('laravel-usp-theme::master')

@section('content')

<form method="POST" action="/suggestions/store_processar_aquisicao/{{$acquisition->id}}">
    @csrf

    <div class="form-group">
      <label for="tombo">Tombo:</label>
      <input type="text" id="tombo" class="form-control" name="tombo">
    </div>

    <div class="form-group">
      <label for="tombo_antigo">Tombo antigo:</label>
      <input type="text" id="tombo_antigo" class="form-control" name="tombo_antigo">
    </div>

    <div class="form-group">
      <label for="cod_impressao">Código de impressão:</label>
      <input type="text" id="cod_impressao" class="form-control" name="cod_impressao">
    </div>

    <div class="form-group">
      <label for="ordem_relatorio">Ordem no relatório:</label>
      <input type="text" id="ordem_relatorio" class="form-control" name="ordem_relatorio">
    </div>

    <div class="form-group">
        <label for="tipo_aquisicao">Tipo de aquisição:</label>
        <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
        <option>Selecionar tipo de aquisição</option>
          <option>Compra</option>
          <option>Doação</option>
          <option>Multa</option>
          <option>Reposição</option>
          <option>Retombamento</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tipo_material">Tipo de material:</label>
        <select class="form-control" id="tipo_material" name="tipo_material">
        <option>Selecionar tipo de material</option>
          <option>Livro</option>
          <option>Material especial</option>
          <option>Memorial</option>
          <option>Multimeios</option>
          <option>Outros tipos</option>
          <option>Periódicos</option>
          <option>Tese</option>
        </select>
    </div>

    <div class="form-group">
        <label for="subcategoria">Subcategoria:</label>
        <select class="form-control" id="subcategoria" class="form-control" name="subcategoria">
        <option>Selecionar subcategoria</option>
          <option>Mestrado</option>
          <option>Doutorado</option>
          <option>Livre docência</option>
        </select>
    </div>

    <div class="form-group">
        <label for="capes">Capes:</label>
        <select class="form-control" id="capes" class="form-control" name="capes">
          <option>Falta...</option>
          <option>Capes2</option>
        </select>
    </div>

    <br><h3>IDENTIFICAÇÃO</h3><br>

    <div class="form-group">
      <label for="id_material">id_material:</label>
      <input type="text" id="id_material" class="form-control" name="id_material">
    </div>

    <div class="form-group">
      <label for="id_sugestao">id_sugestao:</label>
      <input type="text" id="id_sugestao" class="form-control" name="id_sugestao">
    </div>

    <div class="form-group">
      <label for="UsuarioS">UsuarioS:</label>
      <input type="text" id="UsuarioS" class="form-control" name="UsuarioS">
    </div>

    <div class="form-group">
      <label for="UsuarioA">UsuarioA:</label>
      <input type="text" id="UsuarioA" class="form-control" name="UsuarioA">
    </div>

    <br><h3>LIVRO</h3><br>

    <div class="form-group">
      <label for="autor">Autor:</label>
      <input type="text" id="autor" class="form-control" name="autor" value="{{ $acquisition->autor }}">
    </div>

    <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" class="form-control" name="titulo" value="{{ $acquisition->titulo }}">
    </div>

    <div class="form-group">
      <label for="link">Link:</label>
      <input type="text" id="link" class="form-control"  name="link">
    </div>

    <div class="form-group">
      <label for="edicao">Edição:</label>
      <input type="text" id="edicao" class="form-control" name="edicao">
    </div>
    
    <div class="form-group">
      <label for="volume">Volume:</label>
      <input type="text" id="volume" class="form-control" name="volume">
    
    </div>
    <div class="form-group">
      <label for="parte">Parte:</label>
      <input type="text" id="parte" class="form-control" name="parte">
    </div>

    <div class="form-group">
      <label for="fasciculo">Fascículo:</label>
      <input type="text" id="fasciculo" class="form-control" name="fasciculo">
    </div>

    <div class="form-group">
      <label for="local">Local:</label>
      <input type="text" id="local" class="form-control" name="local">
    </div>

    <div class="form-group">
      <label for="editora">Editora:</label>
      <input type="text" id="editora" class="form-control" name="editora" value="{{ $acquisition->editora }}">
    </div>

    <div class="form-group">
      <label for="ano">Ano:</label>
      <input type="text" id="ano" class="form-control" name="ano">
    </div>

    <div class="form-group">
      <label for="colecao">Coleção:</label>
      <input type="text" id="colecao" class="form-control" name="colecao">
    </div>

    <div class="form-group">
      <label for="isbn">ISBN:</label>
      <input type="text" id="isbn" class="form-control" name="isbn">
    </div>

    <div class="form-group">
      <label for="escala">Escala:</label>
      <input type="text" id="escala" class="form-control" name="escala">
    </div>

    <br><h3>OUTRAS INFORMAÇÕES</h3><br>

    <div class="form-group">
        <label for="dpto">Departamento:</label>
        <select class="form-control" id="dpto" name="dpto">
          <option>Selecionar departamento</option>
          <option>Antropologia</option>
          <option>Ciência Politica</option>
          <option>Filosofia</option>
          <option>Geografia</option>
          <option>História</option>
          <option>Letras Clássicas e Vernáculas </option>
          <option>Letras Modernas</option>
          <option>Letras Orientais</option>
          <option>Linguística</option>
          <option>Sociologia</option>
          <option>Teoria Literária e Literatura Comparada</option>
        </select>
    </div>

    <div class="form-group">
      <label for="pedido_por">Pedido por:</label>
      <input type="text" id="pedido_por" class="form-control" name="pedido_por">
    </div>

    <div class="form-group">
      <label for="finalidade">Finalidade:</label>
      <input type="text" id="finalidade" class="form-control" name="finalidade">
    </div>

    <div class="form-group">
      <label for="data_pedido">Data do pedido:</label>
      <input type="text" id="data_pedido" class="form-control" name="data_pedido">
    </div>

    <div class="form-group">
        <label for="prioridade">Prioridade:</label>
        <select class="form-control" id="prioridade" name="prioridade">
        <option>Selecionar prioridade</option>
          <option>Baixa</option>
          <option>Média</option>
          <option>Alta</option>
          <option>Critica</option>
          <option>Coleção Didática</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
        <option>Selecionar status</option>
          <option>Em cotação</option>
          <option>Em licitação</option>
          <option>Em processo de aquisição</option>
          <option>Esgotado</option>
          <option>Para seleção</option>
        </select>
    </div>

    <div class="form-group">
        <label for="moeda">Moeda:</label>
        <select class="form-control" id="moeda" name="moeda">
          <option>Real</option>
          <option>Dólar</option>
        </select>
    </div>


    <div class="form-group">
      <label for="preco">Preço:</label>
      <input type="text" id="preco" class="form-control" name="preco">
    </div>

    <div class="form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option>Nacional</option>
          <option>Internacional</option>
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
        <option>Selecionar verba</option>
          <option>CAPES</option>
          <option>RUSP</option>
          <option>CNPQ</option>
          <option>FAPESP</option>
          <option>FAPLIVROS</option>
          <option>PROAP</option>
        </select>
    </div>

    <div class="form-group">
      <label for="processo">Processo:</label>
      <input type="text" id="processo" class="form-control" name="processo">
    </div>

    <div class="form-group">
      <label for="fornecedor">Fornecedor:</label>
      <input type="text" id="fornecedor" class="form-control" name="fornecedor">
    </div>

    <div class="form-group">
      <label for="nota_fiscal">Nota fiscal:</label>
      <input type="text" id="nota_fiscal" class="form-control" name="nota_fiscal">
    </div>

    <div class="form-group">
      <label for="pasta">Pasta:</label>
      <input type="text" id="pasta" class="form-control" name="pasta">
    </div>

    <div class="form-group">
        <label for="moeda_nf">Moeda:</label>
        <select class="form-control" id="moeda_nf" name="moeda_nf">
          <option>REAL</option>
          <option>DÓLAR</option>
        </select>
    </div>

    <div class="form-group">
      <label for="preco_nf">Preço:</label>
      <input type="text" id="preco_nf" class="form-control" name="preco_nf">
    </div>

    <div class="form-group">
      <label for="">Data:</label>
      <input type="text" id="data_nf" class="form-control" name="data_nf">
    </div>


    <div>
      <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>

</form>

@endsection