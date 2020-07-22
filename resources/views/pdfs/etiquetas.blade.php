<table style='width:100%; padding:1px; border: 0px solid #000'>
    <tr>
        <td style='width:60%;'>
            <span style='font-size: 9px'>
            <b>Verba: </b>{!! App\Utils\Util::limita_caracteres($item->verba , $limiteCaracteres) !!}<br>
            <b>Aquisição: </b>{!! App\Utils\Util::limita_caracteres($item->tipo_aquisicao , $limiteCaracteres) !!}<br>
            <b>Processo: </b> {{ $item->processo }}<br>
            <b>NF: </b> {{ $item->nota_fiscal }}<br>
            <b>Preço: </b> R${{ $item->preco }}<br>
            <b>Fornecedor: </b>{!! App\Utils\Util::limita_caracteres($item->fornecedor , $limiteCaracteres) !!}<br>
            <b>Título: </b>{!! App\Utils\Util::limita_caracteres($item->titulo , $limiteCaracteres) !!}<br>
            <b>Autor: </b>{!! App\Utils\Util::limita_caracteres($item->autor , $limiteCaracteres) !!}<br>  
            </span>
        </td>
        <td style='text-align:center;'>
            {{ $item->tombo }}<br>{!! $codigo !!} SBD/FFLCH
        </td>
    </tr>
</table>