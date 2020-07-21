@foreach($itens as $item)
<table style='width:100%; padding:1px; border: 0px solid #000'>
    <tr>
        <td style='width:60%;'>
            <span style='font-size: 9px'>
            <b>Verba: </b>{{ $item->verba }}<br>
            <b>Aquisição: </b>{{ $item->tipo_aquisicao }}<br>
            <b>Processo: </b> {{ $item->processo }}<br>
            <b>NF: </b> {{ $item->nota_fiscal }}<br>
            <b>Preço: </b> R${{ $item->preco }}<br>
            <b>Fornecedor: </b>{{ $item->fornecedor }}<br>
            <b>Título: </b>{{ $item->titulo }}<br>
            <b>Autor: </b>{{ $item->autor }}<br>  
            </span>
        </td>
        <td style='text-align:center;'>
            {{ $item->tombo }}
            {!! $codigo !!} SBD/FFLCH
        </td>
    </tr>
</table>
@endforeach