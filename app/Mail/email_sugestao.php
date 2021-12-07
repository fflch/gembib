<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Service\GeneralSettings;

class email_sugestao extends Mailable
{
    use Queueable, SerializesModels;
    private $item;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
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

        return $this->view('emails.email_sugestao')
            ->to($sai)
            ->subject('Envio de sugestão')
            ->with([
                'item' => $this->item,
                'aluno' => $aluno,
                
            ]);
    }
}
