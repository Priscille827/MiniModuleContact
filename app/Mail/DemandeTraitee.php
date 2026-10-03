<?php

namespace App\Mail;

use App\Models\DemandeContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemandeTraitee extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DemandeContact $demande)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande ' . $this->demande->numero_demande . ' a été traitée',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.demande-traitee',
        );
    }
}