<table style='width:100%; padding:1px; border: 0px solid #000'>
    <tr>
        <td style='width:60%;'>
            <span style='font-size: 9px'>
            <b>No. Classificação: </b>{{ $item->no_classificacao }}<br>
            <b>No. Cutter: </b>{{ $item->no_cutter }}<br>
            <b>Exemplar: </b>{{ $item->exemplar }}<br>
        @if(!empty($item->parte))
            <b>Parte: </b> {{ $item->processo }}<br>
        @endif
        @if(!empty($item->edicao))
            <b>Edição: </b> {{ $item->edicao }}<br>
        @endif
        @if(!empty($item->volume))
            <b>Volume: </b> {{ $item->volume }}<br> 
        @endif
            <b>Ano: </b>{{ $item->ano }}<br>
            </span>
        </td>
        <td style='text-align:center;'>
            {{ $item->tombo }}<br> SBD/FFLCH
        </td>
    </tr>
</table>