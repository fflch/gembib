<div class="row">
        <div class="col-sm form-group">
          <label for="tombo">Tombo:</label>
          <input type="text" id="tombo" class="form-control" name="tombo"
          @if(isset($item))
            value="{{ $item->tombo }}" />
            @if(empty($item->tombo))
                <small> Próximo tombo disponível no sistema: <b>{{$proximo}}</b> </small>
            @endif
          @else 
            value="{{ $proximo }}" />
          @endif
          
        </div>
        <div class="col-sm form-group">
          <label for="tombo_antigo">Tombo antigo:</label>
          <input type="text" id="tombo_antigo" class="form-control" name="tombo_antigo"
          @if(isset($item))
            value="{{ $item->tombo_antigo }}"
          @endif
          />
        </div>
        <div class="col-sm form-group">
          <label for="tipo_aquisicao">Tipo de aquisição:</label>
          <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
              <option value="">Selecionar tipo de aquisição</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Compra")
                selected
                @endif
              @endif
              >Compra</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Doação")
                selected
                @endif
              @endif
              >Doação</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Multa")
                selected
                @endif
              @endif
              >Multa</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Reposição")
                selected
                @endif
              @endif
              >Reposição</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Retombamento")
                selected
                @endif
              @endif
              >Retombamento</option>
              <option @if(isset($item))
              @if($item->tipo_aquisicao=="Permuta")
                selected
                @endif
              @endif
              >Permuta</option>
          </select>
        </div>
    </div>
<div class="row" onchange="optionCheck()" style="position: relative; ">
  <div class="col-sm form-group">
    <label for="tipo_material">Tipo de material:</label>
    <select class="form-control" id="tipo_material" name="tipo_material">
          <option value=""></option>
    
          @foreach($tipo_material as $tipo)
              <option @if(isset($item)) 
                    @if($item->tipo_material=="$tipo")
                      selected 
                    @endif 
                  @endif
            >{{$tipo}}</option>
          @endforeach

    </select>
 </div>
<!--Textbox após a seleção de "Outros tipos" em "Tipos de materiais"-->
  <div class="col-sm form-group" style="visibility: hidden; position: absolute;">
        <input type="text" style="position: absolute; top: 60px; left: 120px;" id="outromaterial" name="outromaterial" placeholder="Digite outro tipo de material">
  </div>
    <!--Campo Subcategoria-->
  <div id="hiddenDiv" style="visibility:hidden; position: absolute;">
        <select class="form-control" id="subcategoria" name="subcategoria" style="position: relative; top: 60px; left: 120px;"> 
            <option value="">Selecionar subcategoria</option>
            <option>Mestrado</option>
            <option>Doutorado</option>
            <option>Livre-docência</option>
        </select>
  </div>
        <!--Campo Escala-->
  <div class="col-sm form-group" id="hiddenEscala" style="visibility: hidden; position: absolute;">
            <input type="text" style="position: absolute; top: 60px; left: 120px;" id="escala" name="escala" placeholder="Digite a escala do mapa">
  </div>
<div class="col-sm form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" class="form-control" name="titulo"
          @if(isset($item))
            value="{{ $item->titulo }}"
          @endif
        />
      </div>
 <div class="col-sm form-group">
        <label for="autor">Autor:</label>
        <input type="text" id="autor" class="form-control" name="autor"
          @if(isset($item))
            value="{{ $item->autor }}"
          @endif
          />
      </div>
      </div>
      <div class="row">
<div class="col-sm form-group">
      <label for="editora">Editora:</label>
      <input type="text" id="editora" class="form-control" name="editora"
          @if(isset($item))
              value="{{ $item->editora }}"
          @endif
          />
</div>
<div class="col-sm form-group">
        <label for="ano">Ano de publicação:</label>
        <input type="text" id="ano" class="form-control" name='ano'
        @if(isset($item))
            value="{{ $item->ano }}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="volume">Volume:</label>
        <input type="text" id="volume" class="form-control" name="volume"
        @if(isset($item))
            value="{{ $item->volume }}"
          @endif
          />
      </div>
      </div>
      <div class="row">   
      <div class="col-sm form-group">
        <label for="parte">Parte:</label>
        <input type="text" id="parte" class="form-control" name="parte"
        @if(isset($item))
            value="{{ $item->parte }}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="fasciculo">Fascículo:</label>
        <input type="text" id="fasciculo" class="form-control" name="fasciculo"
        @if(isset($item))
            value="{{ $item->fasciculo }}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="local">Local:</label>
        <input type="text" id="local" class="form-control" name="local"
        @if(isset($item))
            value="{{ $item->local}}"
          @endif
          />
      </div>
    </div>
<div class="row">
      <div class="col-sm form-group">
          <label for="colecao">Coleção:</label>
          <input type="text" id="colecao" class="form-control" name="colecao"
          @if(isset($item))
            value="{{ $item->colecao }}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="link">Link:</label>
        <input type="text" id="link" class="form-control"  name="link"
        @if(isset($item))
            value="{{ $item->link }}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="edicao">Edição:</label>
        <input type="text" id="edicao" class="form-control" name="edicao"
        @if(isset($item))
            value="{{ $item->edicao }}"
          @endif
          />
      </div>
    </div>
    <div class="row">
      <div class="col-sm form-group">
          <label for="isbn">ISBN:</label>
          <input type="text" id="isbn" class="form-control" name="isbn"
          @if(isset($item))
            value="{{ $item->isbn }}"
          @endif
          />
        </div>
        <div class="col-sm form-group">
            <label for="dpto">Departamento:</label>
            <select class="form-control" id="dpto" name="dpto">
              <option value="">Selecionar departamento</option>
              <option @if(isset($item))
              @if($item->dpto=="Antropologia")
                selected
                @endif
              @endif
              >Antropologia</option>
              <option @if(isset($item))
              @if($item->dpto=="Ciência Politica")
                selected
                @endif
              @endif
              >Ciência Politica</option>
              <option @if(isset($item))
              @if($item->dpto=="Filosofia")
                selected
                @endif
              @endif
              >Filosofia</option>
              <option @if(isset($item))
              @if($item->dpto=="Geografia")
                selected
                @endif
              @endif
              >Geografia</option>
              <option @if(isset($item))
              @if($item->dpto=="História")
                selected
                @endif
              @endif
              >História</option>
              <option @if(isset($item))
              @if($item->dpto=="Letras Clássicas e Vernáculas")
                selected
                @endif
              @endif
              >Letras Clássicas e Vernáculas </option>
              <option @if(isset($item))
              @if($item->dpto=="Modernas")
                selected
                @endif
              @endif
              >Letras Modernas</option>
              <option @if(isset($item))
              @if($item->dpto=="Letras Orientais")
                selected
                @endif
              @endif
              >Letras Orientais</option>
              <option @if(isset($item))
              @if($item->dpto=="Linguística")
                selected
                @endif
              @endif
              >Linguística</option>
              <option @if(isset($item))
              @if($item->dpto=="Sociologia")
                selected
                @endif
              @endif
              >Sociologia</option>
              <option @if(isset($item))
              @if($item->dpto=="Teoria Literária e Literatura Comparada")
                selected
                @endif
              @endif
              >Teoria Literária e Literatura Comparada</option>
            </select>
        </div>      
        <div class="col-sm form-group">
          <label for="prioridade">Prioridade:</label>
          <select class="form-control" id="prioridade" name="prioridade">
            <option value="">Selecionar prioridade</option>
            <option @if(isset($item))
              @if($item->prioridade=="Coleção Didática")
                selected
                @endif
              @endif
            >Coleção Didática</option>
          </select>
        </div>
      </div>
   <div class="row">      
      <div class="col-sm form-group">
        <label for="procedencia">Procedência:</label>
        <select class="form-control" id="procedencia" name="procedencia">
          <option value="">Selecionar procedência</option>
          <option @if(isset($item))
              @if($item->procedencia=="NACIONAL")
                selected
                @endif
              @endif
          >NACIONAL</option>
          <option @if(isset($item))
              @if($item->procedencia=="INTERNACIONAL")
                selected
                @endif
              @endif
          >INTERNACIONAL</option>
        </select>
      </div>
      <div class="col-sm form-group">
          <label for="capes">Capes:</label>
          <select class="form-control" id="capes" class="form-control" name="capes">
            <option value="">Selecione</option>
            @foreach($areas as $area)
                <option value="{{$area->codigo}}" 
                    @if(isset($item)) 
                        @if($item->capes == $area->codigo)
                            {{$area->codigo}} - {{$area->nome}}
                            selected
                        @endif
                    @endif
                >{{$area->codigo}} - {{$area->nome}}</option>
            @endforeach
          </select>
      </div>
      <div class="col-sm form-group">
        <label for="finalidade">Finalidade:</label>
        <input type="text" id="finalidade" class="form-control" name="finalidade"
        @if(isset($item))
            value="{{ $item->finalidade }}"
          @endif
          />
      </div>
    </div>

    <br><h3>Informações adicionais</h3><br>

    <div class="row">
      <div class="col-sm form-group" style="position: relative;">
          <label for="verba">Verba:</label>
          <select class="form-control" id="verba" name="verba" onchange="mostraCampo(this);">
            <option value="">Selecionar tipo de verba</option>
            <option @if(isset($item))
              @if($item->verba=="CAPES")
                selected
                @endif
              @endif
            >CAPES</option>
            <option @if(isset($item))
              @if($item->verba=="RUSP")
                selected
                @endif
              @endif
            >RUSP</option>
            <option @if(isset($item))
              @if($item->verba=="CNPQ")
                selected
                @endif
              @endif
            >CNPQ</option>
            <option @if(isset($item))
              @if($item->verba=="FAPESP")
                selected
                @endif
              @endif
            >FAPESP</option>
            <option @if(isset($item))
              @if($item->verba=="FAPLIVROS")
                selected
                @endif
              @endif
            >FAPLIVROS</option>
            <option @if(isset($item))
              @if($item->verba=="PROAP")
                selected
                @endif
              @endif
            >PROAP</option>
            <option @if(isset($item))
              @if($item->verba=="Outras")
                selected
                @endif
              @endif
            >Outras</option>
            <!--No campo verba colocar opção “outros” e abrir um box para as informações;-->
          </select>

          <!--Função para abrir campo após seleção de outras verbas-->
          <input type="text" name="outraVerba" id="Outras" style="visibility: hidden; position: absolute; top: 60px; left: 120px;" placeholder="Informe outro tipo de verba">
          <!--fim da Função para abrir campo após seleção de outras verbas-->
      </div>
      <div class="col-sm form-group">
        <label for="processo">Processo:</label>
        <input type="text" id="processo" class="form-control" name="processo"
        @if(isset($item))
            value="{{ $item->processo }}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="fornecedor">Fornecedor:</label>
        <input type="text" id="fornecedor" class="form-control" name="fornecedor"
        @if(isset($item))
            value="{{ $item->fornecedor }}"
          @endif
          />
      </div>
    </div>

    <div class="row">
      <div class="col-sm  form-group">
          <label for="moeda">Moeda:</label>
          <select class="form-control" id="moeda" name="moeda">
            <option value="">Selecionar moeda</option>
            <option @if(isset($item))
              @if($item->moeda=="REAL")
                selected
                @endif
              @endif
            >REAL</option>
            <option @if(isset($item))
              @if($item->moeda=="DÓLAR")
                selected
                @endif
              @endif
            >DÓLAR</option>
          </select>
      </div>
      <div class="col-sm  form-group">
        <label for="preco">Preço:</label>
        <input type="text" id="preco" class="form-control" name="preco"
        @if(isset($item))
            value="{!! str_replace('.', ',', $item->preco) !!}"
          @endif
          />
      </div>
      <div class="col-sm form-group">
        <label for="nota_fiscal">Nota fiscal:</label>
        <input type="text" id="nota_fiscal" class="form-control" name="nota_fiscal"
        @if(isset($item))
            value="{{ $item->nota_fiscal }}"
          @endif
          />
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
          <label for="cod_impressao">Código de impressão:</label>
          <input type="text" id="cod_impressao" class="form-control" name="cod_impressao"
          @if(isset($item))
            value="{{ $item->cod_impressao }}"
          @endif
          />
      </div>
    </div>

    <div class="form-group">
        <label for="observacao">Observações:</label>
        <textarea class="form-control" id="observacao" rows="3" name="observacao">@if(isset($item)){{ $item->observacao }}
  @endif</textarea>
    </div>


    <div>
        <button type="submit" class="btn btn-success"> Enviar </button> 
    </div>

