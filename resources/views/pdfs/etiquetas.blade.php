<table style='width:100%; padding:2px; margin:{{$margem}}; border: 0px solid #000'>
    <tr>
        <td style='width:60%;'>
            <span style='font-size: 9px'>
            @if(!empty($item->verba))<b>Verba: </b>{!! App\Utils\Util::limita_caracteres($item->verba , $limiteCaracteres) !!}<br>@endif
            <b>Aquisição: </b>{!! App\Utils\Util::limita_caracteres($item->tipo_aquisicao , $limiteCaracteres) !!}<br>
            @if(!empty($item->processo))<b>Processo: </b> {{ $item->processo }}<br>@endif
            @if(!empty($item->preco))<b>Preço: </b> R${{ $item->preco }}<br>@endif
            @if(!empty($item->fornecedor))<b>Fornecedor: </b>{!! App\Utils\Util::limita_caracteres($item->fornecedor , $limiteCaracteres) !!}<br>@endif
            <b>Título: </b>{!! App\Utils\Util::limita_caracteres($item->titulo , $limiteCaracteres) !!}<br>
            <b>Autor: </b>{!! App\Utils\Util::limita_caracteres($item->autor , $limiteCaracteres) !!}<br>  
            <b>Data do tombo: </b> {{ $item->data_tombamento }}<br>
            </span>
        </td>
        <td style='text-align:center;'>
            {{ $item->tombo }}<br>{!! $codigo !!} SBD/FFLCH
        </td>
    </tr>
</table>