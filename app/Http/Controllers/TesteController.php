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
<img src='{$imagem}'/>
<h1>FFFLCH</h1>



";

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }

  
}
