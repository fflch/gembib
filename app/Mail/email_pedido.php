<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Service\GeneralSettings;

class email_pedido extends Mailable
{
    use Queueable, SerializesModels;
    private $itens;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($itens)
    {
        $this->itens = Item::wherein('id', $itens)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sai = explode(',',env('EMAILS_SAI'));
        $aluno = auth()->user();
        return $this->view('emails.email_pedido')
            ->to($sai)
            ->subject('Pedido de intem(ns) em processamento técnico')
            ->with([
                'itens' => $this->itens,
                'aluno' => $aluno,
                
            ]);
        
    }
}
