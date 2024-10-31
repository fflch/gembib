<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class mail_processado extends Mailable
{
    use Queueable, SerializesModels;
    private $item;
    /**
     * Create a new message instance.
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'O Item "' . $this->item->titulo . '" foi Processado.',
            to: $this->item->pedido_usuario,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email_processado',
            with: ['item' => $this->item],
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
