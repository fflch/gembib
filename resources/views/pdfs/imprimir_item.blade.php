<div class="card">
  <div class="card-body">
    <table class="table table-striped">
      <tbody>
        @if(isset($item->recebido_sau) && $item->status == "Processado")
        <tr>
          <th scope="col">Material recebebido no SAU por:</th>
          <td scope="row">{{ $item->recebido_sau_por ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->tombo))
        <tr>
          <th scope="col">Tombo:</th>
          <td scope="row">{{ $item->tombo ?? 'Ainda não tombado' }}</td>
        </tr>
        @endif
        @if(!empty($item->data_tombamento))
        <tr>
          <th scope="col">Data do tombamento:</th>
          <td scope="col">{{ $item->data_tombamento ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->data_sugestao))
        <tr>
          <th scope="col">Data da sugestão:</th>
          <td scope="col">{{ $item->data_sugestao ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->data_processamento))
        <tr>
          <th scope="col">Data de envio para processamento técnico:</th>
          <td scope="col">{{ $item->data_processamento ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->data_processado))
        <tr>
          <th scope="col">Data em que foi processado:</th>
          <td scope="col">{{ $item->data_processado ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->cod_impressao))
        <tr>
          <th scope="col">Código de impressão:</th>
          @if(empty($item->cod_impressao))
          <td scope="row">Não cadastrado</td>
          @else
          <td scope="col">{{ $item->cod_impressao }}</a>
          @endif
        </tr>
        @endif
        @if(!empty($item->titulo))
        <tr>
          <th scope="col">Título: </th>
          <td scope="col">{{ $item->titulo }}</td>
        </tr>
        @endif
        @if(!empty($item->autor))
        <tr>
          <th scope="col">Autor:</th>
          <td scope="row">{{ $item->autor }}</td>
        </tr>
        @endif
        @if(!empty($item->status))
        <tr>
          <th scope="col"><b>Status:</b></th>
          <td scope="col">{{ $item->status }}</td>
        </tr>
        @endif
        @if(!empty($item->pedido_por))
        <tr>
          <th scope="col">Item pedido por:</th>
          <td scope="row">{{ $item->pedido_por ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->sugerido_por))
        <tr>
          <th scope="col">Sugerido por:</th>
          <td scope="col">{{ $item->sugerido_por ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->editora))
        <tr>
          <th scope="col">Editora:</th>
          <td scope="row">{{ $item->editora ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->tipo_material))
        <tr>
          <th scope="col">Tipo de material:</th>
          <td scope="row">{{ $item->tipo_material ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->tipo_aquisicao))
        <tr>
          <th scope="col">Tipo de aquisição:</th>
          <td scope="row">{{ $item->tipo_aquisicao ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->edicao))
        <tr>
          <th scope="col">Edição:</th>
          <td scope="row">{{ $item->edicao ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->ano))
        <tr>
          <th scope="col">Ano de publicação:</th>
          <td scope="row">{{ $item->ano ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->sysno))
        <tr>
          <th scope="col">SYSNO:</th>
          <td scope="row">{{ $item->sysno ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->volume))
        <tr>
          <th scope="col">Volume:</th>
          <td scope="row">{{ $item->volume ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->parte))
        <tr>
          <th scope="col">Parte:</th>
          <td scope="row">{{ $item->parte ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->fasciculo))
        <tr>
          <th scope="col">Fascículo:</th>
          <td scope="row">{{ $item->fasciculo ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->colecao))
        <tr>
          <th scope="col">Coleção:</th>
          <td scope="row">{{ $item->colecao ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->local))
        <tr>
          <th scope="col">Local:</th>
          <td scope="row">{{ $item->local ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->link))
        <tr>
          <th scope="col">Link:</th>
          <td scope="row">{{ $item->link ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->escala))
        <tr>
          <th scope="col">Escala:</th>
          <td scope="row">{{ $item->escala ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->subcategoria))
        <tr>
          <th scope="col">Subcategoria:</th>
          <td scope="row">{{ $item->subcategoria ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->departamento))
        <tr>
          <th scope="col">Departamento:</th>
          <td scope="row">{{ $item->departamento ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($area->codigo))
        <tr>
          <th scope="col">Capes:</th>
          <td scope="row">{{ $area->codigo ?? 'Não cadastrado' }} - {{ $area->nome ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->isbn))
        <tr>
          <th scope="col">ISBN:</th>
          <td scope="row">{{ $item->isbn ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->tombo_antigo))
        <tr>
          <th scope="col">Tombo antigo:</th>
          <td scope="row">{{ $item->tombo_antigo ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->prioridade))
        <tr>
          <th scope="col">Prioridade:</th>
          <td scope="row">{{ $item->prioridade ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->procedencia))
        <tr>
          <th scope="col">Procedência:</th>
          <td scope="row">{{ $item->procedencia ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->finalidade))
        <tr>
          <th scope="col">Finalidade:</th>
          <td scope="row">{{ $item->finalidade ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->processo))
        <tr>
          <th scope="col">Processo:</th>
          <td scope="row">{{ $item->processo ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->verba))
        <tr>
          <th scope="col">Verba:</th>
          <td scope="row">{{ $item->verba ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->fornecedor))
        <tr>
          <th scope="col">Fornecedor:</th>
          <td scope="row">{{ $item->fornecedor ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->nota_fiscal))
        <tr>
          <th scope="col">Nota fiscal:</th>
          <td scope="row">{{ $item->nota_fiscal ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->moeda))
        <tr>
          <th scope="col">Moeda:</th>
          <td scope="row">{{ $item->moeda ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->preco))
        <tr>
          <th scope="col">Preço:</th>
          <td scope="row">{{ $item->preco ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
        @if(!empty($item->observacao))
          <th scope="col">Observações:</th>
          <td scope="row">{{ $item->observacao ?? 'Não cadastrado' }}</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>