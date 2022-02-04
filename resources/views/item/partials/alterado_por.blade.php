@if($item->alterado_por)
    por {{ (Uspdev\Replicado\Pessoa::nomeCompleto($item->alterado_por)) ?: '' }}
@endif
