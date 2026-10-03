<?php

namespace App\Mail;

use App\Models\DemandeContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleDemandeAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * On reçoit la demande en paramètre pour l'utiliser dans la vue.
     * "public" => automatiquement accessible dans la vue Blade.
     */
    public function __construct(public DemandeContact $demande)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ' Nouvelle demande reçue : ' . $this->demande->numero_demande,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.nouvelle-demande-admin',
        );
    }
}