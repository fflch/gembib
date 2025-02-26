<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class mail_prioridade extends Mailable
{
    use Queueable, SerializesModels;
    public $itens;
    /**
     * Create a new message instance.
     */
    public function __construct($itens)
    {
        $this->itens = $itens;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'GEMBIB: Há itens com pedido de prioridade no processamento',
            to: env('EMAIL_PRIORIDADE'),
        );
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email_prioridade',
            with: [
                'itens' => $this->itens,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
