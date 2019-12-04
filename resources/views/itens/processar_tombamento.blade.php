@extends('laravel-usp-theme::master')
@section('content')
@include('flash')


<!--Função para abrir campo para a opção outras em prioridade-->
<script type="text/javascript">
function mostraCampoPrioridade(obj) {
    var select = document.getElementById('prioridade');
    var txt = document.getElementById("outraPrioridade");
    txt.style.visibility = (select.value == 'Outras') 
        ? "visible"
        : "hidden";  
  }
</script>
<!--fim da Função para abrir campo para a opção outras em prioridade-->

<!--Função para abrir o campo "Subcategoria" quando "Teses for selecionado em "Tipo de material"-->
<!-- fim função mostrar campo subcategoria-->


<!--Função para abrir campo após seleção de outras verbas-->
<script type="text/javascript">
function mostraCampo(obj) {
    var select = document.getElementById('verba');
    var txt = document.getElementById("outraVerba");
    txt.style.visibility = (select.value == 'Outras') 
        ? "visible"
        : "hidden";  
  }
</script>
<!--fim da Função para abrir campo após seleção de outras verbas-->


<!--Função para abrir campo após seleção de outros status-->
<script type="text/javascript">
function mostraCampoStatus(obj) {
    var select = document.getElementById('status');
    var txt = document.getElementById("Outro");
    txt.style.visibility = (select.value == 'Outro') 
        ? "visible"
        : "hidden";  
  }
</script>
<!--fim da Função para abrir campo após seleção de outros status-->


<p><b>Sugestão enviada em:</b> {{ $tombamento->data_sugestao }}</p>

<!--mudar nome para TOMBAMENTO-->

<form method="POST" action="/itens/store_processar_tombamento/{{$tombamento->id}}">
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
    </div>


    <div class="row">
      <div class="col-sm form-group">
          <label for="tipo_tombamento">Tipo de aquisição:</label>
          <select class="form-control" id="tipo_tombamento" name="tipo_tombamento">
            <option value="">Selecionar tipo de aquisição</option>
            <option>Compra</option>
            <option>Doação</option>
            <option>Multa</option>
            <option>Reposição</option>
            <option>Retombamento</option>
          </select>
      </div>
      <div class="col-sm form-group">
          <label for="tipo_material">Tipo de material:</label>
          <select class="form-control" id="tipo_material" onchange="optionCheck()" name="tipo_material">
            <option value="">Selecionar tipo de material</option>
            <option>Livro</option>
            <option value="mapa">Mapas</option>
            <option>Multimeios</option>
            <option>Obra rara</option>
            <option>Periódicos</option>
            <option>CD/DVD</option>
            <option value="teses">Teses</option>
            <option>Outros tipos</option>
          </select>
        </div>

<div id="hiddenDiv" style="visibility:hidden;">

    <div class="row">
      <div class="col-sm form-group">
      <label for="subcategoria">Subcategoria:</label>
      <select class="form-control" id="subcategoria" class="form-control" name="subcategoria">
      <option value="">Selecionar subcategoria</option>
        <option>Mestrado</option>
        <option>Doutorado</option>
        <option>Livre docência</option>
    </select>
        </div>
      </div>
    </div>

</div>

<script type="text/javascript">
  function optionCheck(){
      var option = document.getElementById("tipo_material").value;
      if(option == "teses"){
        document.getElementById("hiddenDiv").style.visibility ="visible";
      }
      if(option != "teses"){//se for diferente da opção "teses" o campo sumirá
        document.getElementById("hiddenDiv").style.visibility ="hidden";
      }
    }
</script>

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
        <input type="text" id="autor" class="form-control" name="autor" value="{{ $tombamento->autor }}">
      </div>
      <div class="col-sm form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" class="form-control" name="titulo" value="{{ $tombamento->titulo }}">
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
        <input type="text" id="editora" class="form-control" name="editora" value="{{ $tombamento->editora }}">
      </div>
      <div class="col-sm form-group">
        <label for="ano">Ano de publicação:</label>
        <input type="text" id="ano" class="form-control" name="ano" value="{{ $tombamento->ano }}">
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

      <!--Este campo só aparece caso a opção em "Tipo de materiais" for "Mapas"-->
    <div class="col-sm form-group">
        <label for="escala">Escala:</label>
        <input type="text" id="escala" class="form-control" name="escala">
      </div>
    <div class="col-sm form-group">
          <label for="dpto">Departamento:</label>
          <select class="form-control" id="dpto" name="dpto">
            <option value="">Selecionar departamento</option>
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
    </div>


    <div class="row">
      <div class="col-sm form-group">
          <label for="prioridade">Prioridade:</label>
          <select class="form-control" id="prioridade" name="prioridade" onchange="mostraCampoPrioridade(this);">
           <option value="">Selecionar prioridade</option>
            <option>Coleção Didática</option>
            <option>Outras</option>
          </select>
          <!--Função para abrir campo após seleção de outras prioridades-->
          <input type="text" class="form-control" name="outraPrioridade" id="outraPrioridade" style="visibility: hidden;" placeholder="Informe outro tipo de prioridade">
          <!--fim da Função para abrir campo após seleção de outras prioridades-->
      </div>
      <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status" onchange="mostraCampoStatus(this);">
          <option value="">Mudar status</option>
          <option>Em processo de aquisição</option>
          <option>Negado</option>
          <option>Esgotado</option>
          <option>Em cotação</option>
          <option>Em licitação</option>
          <option>Outro</option>
        </select>

        <!--Função para abrir campo após seleção de outro status-->
        <input type="text" class="form-control" name="outroStatus" id="Outro" style="visibility: hidden;" placeholder="Informe outro status" >
        <!--fim da Função para abrir campo após seleção de outro status-->

    </div>
      <div class="col-sm form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option value="">Selecionar procedência</option>
          <option>Nacional</option>
          <option>Internacional</option>
        </select>
      </div>
    </div>


    <br><h3>Informações adicionais</h3><br>

    <div class="row">
      <div class="col-sm form-group">
          <label for="verba">Verba:</label>
          <select class="form-control" id="verba" name="verba" onchange="mostraCampo(this);">
            <option value="">Selecionar tipo de verba</option>
            <option>CAPES</option>
            <option>RUSP</option>
            <option>CNPQ</option>
            <option>FAPESP</option>
            <option>FAPLIVROS</option>
            <option>PROAP</option>
            <option>Outras</option>
            <!--No campo verba colocar opção “outros” e abrir um box para as informações;-->
          </select>

          <!--Função para abrir campo após seleção de outras verbas-->
          <input type="text" class="form-control" name="outraVerba" id="outraVerba" style="visibility: hidden;" placeholder="Informe outro tipo de verba">
          <!--fim da Função para abrir campo após seleção de outras verbas-->
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

          <label for="moeda">Moeda:</label>
          <select class="form-control" id="moeda" name="moeda">
            <option value="">Selecionar moeda</option>
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
          <label for="cod_impressao">Código de impressão:</label>
          <input type="text" id="cod_impressao" class="form-control" name="cod_impressao">
      </div>
    </div>

    <div class="form-group">
        <label for="observacao">Observações:</label>
        <textarea class="form-control" id="observacao" rows="3" name="observacao"></textarea>
    </div>
    
    <div>
      <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>
    
</form>

@endsection
