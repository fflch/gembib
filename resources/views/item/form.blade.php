@section('javascripts_head')
@parent
    <script src="/js/item.js"></script>
@endsection

<div class="row">
  <div class="col-sm form-group">
    <label for="tipo_aquisicao">Tipo de aquisição:</label>
    <select class="form-control" id="tipo_aquisicao" name="tipo_aquisicao">
    @if(! $item->tipo_aquisicao)
      <option value="">Selecionar tipo de aquisição</option>
    @endif
      @foreach($item::tipo_aquisicao as $option)
        @if (old('tipo_aquisicao') == '' and isset($item->tipo_aquisicao))
          <option value="{{$option}}" {{($item->tipo_aquisicao == $option) ? 'selected' : ''}}>
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
  <div class="col-sm form-group">
    <label for="tipo_material">Tipo de material:</label>
    <select class="form-control" id="tipo_material" name="tipo_material">
    @if(! $item->tipo_material)
      <option value="">Selecionar tipo de material</option>
    @endif
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
</div>

<div class="row">    
  <div class="col-sm form-group">
  <label for="titulo">Título:</label>
  <input type="text" id="titulo" value="{{old('titulo', $item->titulo )}}" class="form-control" name="titulo"/>
  </div>
 <div class="col-sm form-group">
  <label for="autor">Autor:</label>
  <input type="text" id="autor" value="{{old('autor', $item->autor)}}" class="form-control" name="autor"/>
  </div>
  <div class="col-sm form-group">
    <label for="editora">Editora:</label>
    <input type="text" id="editora" value="{{old('editora', $item->editora)}}" class="form-control" name="editora"/>
  </div>
</div>

<div class="row">
  <div class="col-sm form-group">
      <label for="cod_impressao">Código de impressão:</label>
      <input type="text" id="cod_impressao" value="{{old('cod_impressao',$item->cod_impressao)}}" class="form-control" name="cod_impressao"/>
  </div>
  <div class="col-sm form-group">
    <label for="ano">Ano de publicação:</label>
    <input type="text" id="ano" value="{{old('ano',$item->ano)}}" class="form-control" name='ano'/>
  </div>
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
</div>
<div class="row">   
  <div class="col-sm form-group">
    <label for="parte">Parte:</label>
    <input type="text" id="parte" value="{{old('parte', $item->parte)}}" class="form-control" name="parte"/>
  </div>
  <div class="col-sm form-group">
    <label for="fasciculo">Fascículo:</label>
    <input type="text" id="fasciculo" value="{{old('fasciculo', $item->fasciculo)}}" class="form-control" name="fasciculo"/>
  </div>
  <div class="col-sm form-group">
    <label for="local">Local:</label>
    <input type="text" id="local" value="{{old('local', $item->local)}}" class="form-control" name="local"/>
  </div>
</div>
<div class="row">
  <div class="col-sm form-group">
    <label for="colecao">Coleção:</label>
    <input type="text" id="colecao" value="{{old('colecao', $item->colecao)}}" class="form-control" name="colecao"/>
  </div>
  <div class="col-sm form-group">
    <label for="link">Link do E-book:</label>
    <input type="text" id="link" value="{{old('link', $item->link)}}" class="form-control"  name="link"/>
  </div>
  <div class="col-sm form-group">
    <label for="edicao">Edição:</label>
    <input type="text" id="edicao" value="{{old('edicao', $item->edicao)}}" class="form-control" name="edicao"/>
  </div>
</div>
<div class="row">
  <div class="col-sm form-group">
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" value="{{old('isbn', $item->isbn)}}" class="form-control" name="isbn"/>
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
      @foreach($item::prioridade as $key=>$opcao)
      @if (old('prioridade') == '' and isset($item->prioridade))
          <option value="{{$key}}" {{ ($item->prioridade == $key) ? 'selected' : ''}}>
            {{ $key }} - {{$opcao}}
          </option>
      @else
        <option value = "{{$key}}" {{ ( old('prioridade') == $key) ? 'selected' : ''}}>
          {{ $key }} - {{$opcao}}
        </option>
      @endif
      @endforeach
    </select>
  </div>

  <div class="col-sm form-group">
    <label for="subcategoria">Subcategoria:</label>
    <select class="form-control" id="subcategoria" name="subcategoria">
        <option value="">Subcategoria da tese</option>
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
    <label for="volume">Volume:</label>
    <input type="text" id="volume" value="{{old('volume', $item->volume)}}" class="form-control" name="volume"/>
  </div>
  <div class="col-sm form-group">
    <label for="volume">SYSNO:</label>
    <input type="text" id="sysno" value="{{old('sysno', $item->sysno)}}" class="form-control" name="sysno"/>
  </div>
  <div class="col-sm form-group">
    <label for="capes">Capes:</label>
    <select class="form-control" id="capes" class="form-control" name="capes">
      <option value="">Selecione</option>

      @foreach(App\Models\Area::all() as $area)

        {{-- Edição --}} 
        @if( old('capes') == '' and isset($item->capes))
            <option value="{{$area->codigo}}" {{ ($item->capes == $area->codigo) ? 'selected' : ''}}>
            {{$area->codigo}} - {{$area->nome}}
            </option>
        {{-- Novo cadastro --}} 
        @else
          <option value = "{{$area->codigo}}" {{ ( old('capes') == $area->codigo) ? 'selected' : ''}}>
          {{$area->codigo}} - {{$area->nome}}
        </option>
        @endif

      @endforeach
    </select>
  </div>
  <div class="col-sm form-group">
    <label for="finalidade">Finalidade:</label>
    <input type="text" id="finalidade" value="{{old('finalidade', $item->finalidade)}}" class="form-control" name="finalidade"/>
  </div>

  <div class="col-sm form-group">
    <label for="titulo">Escala:</label>
    <input type="text" id="escala" value="{{old('escala', $item->escala)}}" class="form-control" name="escala" placeholder="Digite a escala do mapa"/>
  </div>
</div>

<br><h3>Informações adicionais</h3>
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
    <input type="text" id="processo" value="{{old('processo', $item->processo)}}" class="form-control" name="processo"/>
  </div>
  <div class="col-sm form-group">
    <label for="fornecedor">Fornecedor:</label>
    <input type="text" id="fornecedor" value="{{old('fornecedor', $item->fornecedor)}}" class="form-control" name="fornecedor"/>
  </div>
  <div class="col-sm form-group">
    <label for="pedido_por">Item sugerido por:</label>
    <input type="text" id="pedido_por" value="{{old('pedido_por', $item->pedido_por)}}" class="form-control" name="pedido_por"/>
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
    <input type="text" id="preco" value="{{old('preco', $item->preco)}}" class="form-control" name="preco" />
  </div>

  <div class="col-sm form-group">
    <label for="nota_fiscal">Nota fiscal:</label>
    <input type="text" id="nota_fiscal" value="{{old('nota_fiscal', $item->nota_fiscal)}}" class="form-control" name="nota_fiscal"/>
  </div>
</div>

  @if($item->status != 'Em Tombamento')
    @include('item.observacao')
  @endif


