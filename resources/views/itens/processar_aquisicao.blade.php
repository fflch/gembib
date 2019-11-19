@extends('laravel-usp-theme::master')
@section('content')
@include('flash')

<!--mudar nome para TOMBAMENTO-->

<form method="POST" action="/itens/store_processar_aquisicao/{{$acquisition->id}}">
    @csrf

    <div class="row">
        <div class="col-sm form-group">
          <label for="tombo">Tombo:</label>
          <input type="text" id="tombo" class="form-control" name="tombo">
        </div>
        <div class="col-sm form-group">
          <label for="tombo_antigo">Tombo antigo:</label>
          <input type="text" id="tombo_antigo" class="form-control" name="tombo_antigo">
        </div>
        <div class="col-sm form-group">
          <label for="ordem_relatorio">Ordem no relatório:</label>
          <input type="text" id="ordem_relatorio" class="form-control" name="ordem_relatorio">
        </div>
    </div>


    <div class="row">
      <div class="col-sm form-group">
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
      <div class="col-sm form-group">
          <label for="tipo_material">Tipo de material:</label>
          <select class="form-control" id="tipo_material" name="tipo_material">
          <option>Selecionar tipo de material</option>
            <option>Livro</option>
            <option>Mapas</option>
            <option>Material especial</option>
            <option>Memorial</option>
            <option>Multimeios</option>
            <option>Obra Rara</option>
            <option>Outros tipos</option>
            <option>Mapas</option>
            <option>Periódicos</option>
            <option>Tese</option>
          </select>
      </div>

    </div>
<!--- O campo subcategoria só aparece se escolher “tese” em tipo de material;-->
    <div class="row">

      <div class="col-sm form-group">
          <label for="subcategoria">Subcategoria:</label>
          <select class="form-control" id="subcategoria" class="form-control" name="subcategoria">
          <option>Selecionar subcategoria</option>
            <option>Mestrado</option>
            <option>Doutorado</option>
            <option>Livre docência</option>
          </select>
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
          <label for="capes">Capes:</label>
          <select class="form-control" id="capes" class="form-control" name="capes">
            @foreach($areas as $area)
              <option>{{$area->codigo}} - {{$area->nome}}</option>
            @endforeach
          </select>
      </div>
      <div class="col-sm form-group">
        <label for="autor">Autor:</label>
        <input type="text" id="autor" class="form-control" name="autor" value="{{ $acquisition->autor }}">
      </div>
      <div class="col-sm form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" class="form-control" name="titulo" value="{{ $acquisition->titulo }}">
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <label for="link">Link:</label>
        <input type="text" id="link" class="form-control"  name="link">
      </div>
      <div class="col-sm form-group">
        <label for="edicao">Edição:</label>
        <input type="text" id="edicao" class="form-control" name="edicao">
      </div>
      <div class="col-sm form-group">
        <label for="volume">Volume:</label>
        <input type="text" id="volume" class="form-control" name="volume">
      </div>
    </div>


    <div class="row">      
      <div class="col-sm form-group">
        <label for="parte">Parte:</label>
        <input type="text" id="parte" class="form-control" name="parte">
      </div>
      <div class="col-sm form-group">
        <label for="fasciculo">Fascículo:</label>
        <input type="text" id="fasciculo" class="form-control" name="fasciculo">
      </div>
      <div class="col-sm form-group">
        <label for="local">Local:</label>
        <input type="text" id="local" class="form-control" name="local">
      </div>
    </div>


    <div class="row">
      <div class="col-sm form-group">
        <label for="editora">Editora:</label>
        <input type="text" id="editora" class="form-control" name="editora" value="{{ $acquisition->editora }}">
      </div>
      <div class="col-sm form-group">
        <label for="ano">Ano:</label>
        <input type="text" id="ano" class="form-control" name="ano" value="{{ $acquisition->ano }}">
      </div>
      <div class="col-sm form-group">
        <label for="colecao">Coleção:</label>
        <input type="text" id="colecao" class="form-control" name="colecao">
      </div>
    </div>


    <div class="row">
      <div class="col-sm form-group">
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" class="form-control" name="isbn">
      </div>
      <div class="col-sm form-group">
        <label for="escala">Escala:</label>
        <input type="text" id="escala" class="form-control" name="escala">
      </div>
      <div class="col-sm form-group">
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
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <label for="pedido_por">Pedido por:</label>
        <input type="text" id="pedido_por" class="form-control" name="pedido_por">
      </div>
      <div class="col-sm form-group">
        <label for="finalidade">Finalidade:</label>
        <input type="text" id="finalidade" class="form-control" name="finalidade">
      </div>
      <div class="col-sm form-group">

        <label for="data_pedido">Data do pedido:</label>
        <input type="text" id="data_pedido" class="form-control" name="data_pedido">
      </div>
    </div>


    <div class="row">
      <div class="col-sm form-group">
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
      <div class="col-sm form-group">
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
      <div class="col-sm form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option>Nacional</option>
          <option>Internacional</option>
        </select>
      </div>
    </div>

    <div class="form-group">
        <label for="observacao">Observações:</label>
        <textarea class="form-control" id="observacao" rows="3" name="observacao"></textarea>
    </div>

    <br><h3>Informações adicionais</h3><br>

    <div class="row">
      <div class="col-sm form-group">
          <label for="verba">Verba:</label>
          <select class="form-control" id="verba" name="verba">
          <option>Selecionar verba</option>
            <option>CAPES</option>
            <option>RUSP</option>
            <option>CNPQ</option>
            <option>FAPESP</option>
            <option>FAPLIVROS</option>
            <option>PROAP</option>
            <option>Outros</option>
            <!--No campo verba colocar opção “outros” e abrir um box para as informações;-->
          </select>
      </div>
      <div class="col-sm form-group">
        <label for="processo">Processo:</label>
        <input type="text" id="processo" class="form-control" name="processo">
      </div>
      <div class="col-sm form-group">
        <label for="fornecedor">Fornecedor:</label>
        <input type="text" id="fornecedor" class="form-control" name="fornecedor">
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <label for="nota_fiscal">Nota fiscal:</label>
        <input type="text" id="nota_fiscal" class="form-control" name="nota_fiscal">
      </div>
      <div class="col-sm  form-group">

          <label for="moeda_nf">Moeda:</label>
          <select class="form-control" id="moeda_nf" name="moeda_nf">
            <option>REAL</option>
            <option>DÓLAR</option>
          </select>

      </div>
      <div class="col-sm  form-group">
        <label for="preco">Preço:</label>
        <input type="text" id="preco" class="form-control" name="preco">

      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <label for="">Data:</label>
        <input type="text" id="data_nf" class="form-control" name="data_nf">
      </div>
      <div class="col-sm form-group">
          <label for="cod_impressao">Código de impressão:</label>
          <input type="text" id="cod_impressao" class="form-control" name="cod_impressao">
      </div>
    </div>
    
    <div>
      <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>
    
</form>

@endsection
