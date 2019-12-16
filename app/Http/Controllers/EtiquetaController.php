<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;

class EtiquetaController extends Controller
{
    public function show(){

        $pimaco = new Pimaco('6180');
        $x = ['maria', 'pedro', 'josé','maria', 'pedro', 'josé','maria', 'pedro'];

        foreach($x as $i){
            $tag = new Tag();
            $tag->setBorder(0.2);
            $tag->setSize(3);
            $tag->p("SDB/ FFLCH / USP<br><hr>");
            $tag->p($i);

            $tag->p("dw dhjkwdw dhjkwdw dhjkwdw dhjkwdw dhjkwdw");

            $barcode = new Barcode('123445', null);

            $barcode->setAlign('right');
            $barcode->setWidth(1);

            $tag->addBarcode($barcode);
            $pimaco->addTag($tag);
        }

        $pimaco->output();
    }
}
