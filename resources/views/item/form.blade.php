@section('javascripts_head')
@parent
    <script src="/js/item.js"></script>
@endsection

<div class="row">
  <div class="col-sm form-group">
    <label for="tombo_antigo">Tombo antigo:</label>
    <input type="text" id="tombo_antigo" value="{{old('tombo_antigo')}}" class="form-control" name="tombo_antigo"
    @if(isset($item))
      value="{{ $item->tombo_antigo }}"
    @endif
    />
  </div>
  <div class="col-sm form-group">
    <label for="tipo_aquisicao">Tipo de aquisição:</label>
    <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
      <option value="">Selecionar tipo de aquisição</option>
      @foreach($item::tipo_aquisicao as $option)
        @if (old('tipo_aquisicao') == '' and isset($item->tipo_aquisicao))
          <option value="{{$option}}" {{ ($item->tipo_aquisicao == $option) ? 'selected' : ''}}>
            {{$option}}
          </option>
        @else
          <option value = "{{$option}}" {{ ( old('tipo_aquisicao') == $option) ? 'selected' : ''}}>
          {{$option}}
        </option>
      @endif
    @endforeach
    </select>
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
    <label for="tipo_material">Tipo de material:</label>
    <select class="form-control" id="tipo_material" name="tipo_material">
      <option value="">Selecionar tipo de material</option>
      @foreach($item::tipo_material as $tipo)
        @if (old('tipo_material') == '' and isset($item->tipo_material))
          <option value="{{$tipo}}" {{ ($item->tipo_material == $tipo) ? 'selected' : ''}}>
            {{$tipo}}
          </option>
        @else
          <option value = "{{$tipo}}" {{ ( old('tipo_material') == $tipo) ? 'selected' : ''}}>
          {{$tipo}}
        </option>
        @endif
      @endforeach
    </select>
 </div>
    
<div class="col-sm form-group">
  <label for="titulo">Título:</label>
  <input type="text" id="titulo" value="{{old('titulo')}}" class="form-control" name="titulo"
    @if(isset($item))
      value="{{ $item->titulo }}"
    @endif
  />
</div>
 <div class="col-sm form-group">
        <label for="autor">Autor:</label>
        <input type="text" id="autor" value="{{old('autor')}}" class="form-control" name="autor"
          @if(isset($item))
            value="{{ $item->autor }}"
          @endif
          />
      </div>
</div>

<div class="row">
  <div class="col-sm form-group">
    <label for="editora">Editora:</label>
    <input type="text" id="editora" value="{{old('editora')}}" class="form-control" name="editora"
      @if(isset($item))
        value="{{ $item->editora }}"
      @endif
        />
  </div>
  <div class="col-sm form-group">
    <label for="ano">Ano de publicação:</label>
    <input type="text" id="ano" value="{{old('ano')}}" class="form-control" name='ano'
      @if(isset($item))
        value="{{ $item->ano }}"
      @endif
      />
  </div>
  <div class="col-sm form-group">
    <label for="volume">Volume:</label>
    <input type="text" id="volume" value="{{old('volume')}}" class="form-control" name="volume"
      @if(isset($item))
        value="{{ $item->volume }}"
      @endif
      />
  </div>
</div>
<div class="row">   
  <div class="col-sm form-group">
    <label for="parte">Parte:</label>
    <input type="text" id="parte" value="{{old('parte')}}" class="form-control" name="parte"
      @if(isset($item))
        value="{{ $item->parte }}"
      @endif
      />
  </div>
  <div class="col-sm form-group">
    <label for="fasciculo">Fascículo:</label>
    <input type="text" id="fasciculo" value="{{old('fasciculo')}}" class="form-control" name="fasciculo"
      @if(isset($item))
        value="{{ $item->fasciculo }}"
      @endif
      />
  </div>
  <div class="col-sm form-group">
    <label for="local">Local:</label>
    <input type="text" id="local" value="{{old('local')}}" class="form-control" name="local"
      @if(isset($item))
        value="{{ $item->local}}"
      @endif
      />
  </div>
</div>
<div class="row">
  <div class="col-sm form-group">
    <label for="colecao">Coleção:</label>
    <input type="text" id="colecao" value="{{old('colecao')}}" class="form-control" name="colecao"
      @if(isset($item))
        value="{{ $item->colecao }}"
      @endif
    />
  </div>
  <div class="col-sm form-group">
    <label for="link">Link:</label>
    <input type="text" id="link" value="{{old('link')}}" class="form-control"  name="link"
      @if(isset($item))
        value="{{ $item->link }}"
      @endif
      />
  </div>
  <div class="col-sm form-group">
    <label for="edicao">Edição:</label>
    <input type="text" id="edicao" value="{{old('edicao')}}" class="form-control" name="edicao"
      @if(isset($item))
        value="{{ $item->edicao }}"
      @endif
      />
  </div>
</div>
<div class="row">
  <div class="col-sm form-group">
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" value="{{old('isbn')}}" class="form-control" name="isbn"
      @if(isset($item))
        value="{{ $item->isbn }}"
      @endif
    />
  </div>
  <div class="col-sm form-group">
    <label for="departamento">Departamento:</label>
    <select class="form-control" id="departamento" name="departamento">
      <option value="">Selecionar departamento</option>
      @foreach($item::departamento as $dpto)
      @if (old('departamento') == '' and isset($item->departamento))
          <option value="{{$dpto}}" {{ ($item->departamento == $dpto) ? 'selected' : ''}}>
            {{$dpto}}
          </option>
      @else
        <option value = "{{$dpto}}" {{ ( old('departamento') == $dpto) ? 'selected' : ''}}>
        {{$dpto}}
      </option>
      @endif
      @endforeach
    </select>
  </div>      
  <div class="col-sm form-group">
    <label for="prioridade">Prioridade:</label>
    <select class="form-control" id="prioridade" name="prioridade">
      <option value="">Selecionar prioridade</option>
      @foreach($item::prioridade as $opcao)
      @if (old('prioridade') == '' and isset($item->prioridade))
          <option value="{{$opcao}}" {{ ($item->prioridade == $opcao) ? 'selected' : ''}}>
            {{$opcao}}
          </option>
      @else
        <option value = "{{$opcao}}" {{ ( old('prioridade') == $opcao) ? 'selected' : ''}}>
        {{$opcao}}
      </option>
      @endif
      @endforeach
    </select>
  </div>

  <div class="col-sm form-group">
    <label for="subcategoria">Subcategoria:</label>
    <select class="form-control" id="subcategoria" name="subcategoria">
        <option value="">Subcategoria da tese:</option>
        @foreach($item::subcategoria as $sub)
        @if (old('subcategoria') == '' and isset($item->subcategoria))
          <option value="{{$sub}}" {{ ($item->subcategoria == $sub) ? 'selected' : ''}}>
            {{$sub}}
          </option>
      @else
        <option value = "{{$sub}}" {{ ( old('subcategoria') == $sub) ? 'selected' : ''}}>
        {{$sub}}
      </option>
      @endif
      @endforeach
    </select>
 </div>
</div>
<div class="row">      
  <div class="col-sm form-group">
    <label for="procedencia">Procedência:</label>
    <select class="form-control" id="procedencia" name="procedencia">
      <option value="">Selecionar procedência</option>
      @foreach($item::procedencia as $p)
      @if (old('procedencia') == '' and isset($item->procedencia))
          <option value="{{$p}}" {{ ($item->procedencia == $p) ? 'selected' : ''}}>
            {{$p}}
          </option>
      @else
        <option value = "{{$p}}" {{ ( old('procedencia') == $p) ? 'selected' : ''}}>
        {{$p}}
      </option>
      @endif
      @endforeach
    </select>
  </div>
  <div class="col-sm form-group">
    <label for="capes">Capes:</label>
    <select class="form-control" id="capes" class="form-control" name="capes">
      <option value="">Selecione</option>
      @foreach(App\Area::all() as $area)
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
    <input type="text" id="finalidade" value="{{old('finalidade')}}" class="form-control" name="finalidade"
    @if(isset($item))
        value="{{ $item->finalidade }}"
      @endif
      />
  </div>

  <div class="col-sm form-group">
    <label for="titulo">Escala:</label>
    <input type="text" id="escala" value="{{old('escala')}}" class="form-control" name="escala" placeholder="Digite a escala do mapa"
    @if(isset($item))
        value="{{ $item->escala }}"
      @endif
      />
  </div>
</div>

<br><h3>Informações adicionais</h3><br>
<div class="row">
  <div class="col-sm form-group">
      <label for="verba">Verba:</label>
      <select class="form-control" id="verba" name="verba" >
        <option value="">Selecionar tipo de verba</option>
        @foreach($item::verba as $v)
      @if (old('verba') == '' and isset($item->verba))
          <option value="{{$v}}" {{ ($item->verba == $v) ? 'selected' : ''}}>
            {{$v}}
          </option>
      @else
        <option value = "{{$v}}" {{ ( old('verba') == $v) ? 'selected' : ''}}>
        {{$v}}
      </option>
      @endif
      @endforeach
      </select>
  </div>
  <div class="col-sm form-group">
    <label for="processo">Processo:</label>
    <input type="text" id="processo" value="{{old('processo')}}" class="form-control" name="processo"
    @if(isset($item))
        value="{{ $item->processo }}"
      @endif
      />
  </div>
  <div class="col-sm form-group">
    <label for="fornecedor">Fornecedor:</label>
    <input type="text" id="fornecedor" value="{{old('fornecedor')}}" class="form-control" name="fornecedor"
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
        @foreach($item::moeda as $m)
      @if (old('moeda') == '' and isset($item->moeda))
          <option value="{{$m}}" {{ ($item->moeda == $m) ? 'selected' : ''}}>
            {{$m}}
          </option>
      @else
        <option value = "{{$m}}" {{ ( old('moeda') == $m) ? 'selected' : ''}}>
        {{$m}}
      </option>
      @endif
      @endforeach
      </select>
  </div>
  <div class="col-sm  form-group">
    <label for="preco">Preço:</label>
    <input type="text" id="preco" value="{{old('preco')}}" class="form-control" name="preco"
    @if(isset($item))
        value="{!! str_replace('.', ',', $item->preco) !!}"
      @endif
      />
  </div>
  <div class="col-sm form-group">
    <label for="nota_fiscal">Nota fiscal:</label>
    <input type="text" id="nota_fiscal" value="{{old('nota_fiscal')}}" class="form-control" name="nota_fiscal"
    @if(isset($item))
        value="{{ $item->nota_fiscal }}"
      @endif
      />
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
      <label for="cod_impressao">Código de impressão:</label>
      <input type="text" id="cod_impressao" value="{{old('cod_impressao')}}" class="form-control" name="cod_impressao"
      @if(isset($item))
        value="{{ $item->cod_impressao }}"
      @endif
      />
  </div>
</div>

<div class="form-group">
  <label for="observacao">Observações:</label>
  <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ old('observacao') }}  @if(isset($item)){{ $item->observacao }}
@endif</textarea>
</div>

