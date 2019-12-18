<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class TesteController extends Controller
{    
    public function teste()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $base = url('/');
        $imagem = './images/logo.png';
        
        $html = "


<table style='width:100%'>
    <tr>
        <td style='width:20%' style='text-align:left;'>
            <img src='{$imagem}' width='230px'/>
        </td>
        <td style='width:80%'; style='text-align:center;'>
            <p align='center'><b>SERVIÇO DE BIBLIOTECA E DOCUMENTAÇÃO</b><br>
            FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS - USP<br>
            Av.: Prof. Lineu Prestes - travessa 12. n° 350 CEP: 05508-900 - Cidade Universitária - São Paulo - SP / Brasil<br>
            Serviço de Aquisição e Intercâmbio (11)3091-4502 - saifflch@usp.br</p>
        </td>
    </tr>
</table>








";

//<img src='{$imagem}' style='width:20%'/>
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }

  
}
