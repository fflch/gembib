<table style='width:100%; padding:1px; border: 0px solid #000'>
    <tr>
        <td style='width:60%;'>
        @foreach($itens as $item)
            <span style='font-size: 9px'>
            <b>Verba: </b>{{ $item->verba, $limiteCaracteres }}<br>
            <b>Aquisição: </b>{{ $item->tipo_aquisicao , $limiteCaracteres }}<br>
            <b>Processo: </b> {{ $item->processo }}<br>
            <b>NF: </b> {{ $item->nota_fiscal }}<br>
            <b>Preço: </b> R${{ $item->preco }}<br>
            <b>Fornecedor: </b>{{ $item->fornecedor }}<br>
            <b>Título: </b>{{ $item->titulo }}<br>
            <b>Autor: </b>{{ $item->autor }}<br>  
            </span>
            @endforeach
        </td>
        <td style='text-align:center;'>
            {{ $item->tombo }}
          
            {{ $barcode->render() }} <br>SBD/FFLCH
        </td>
    </tr>
</table>