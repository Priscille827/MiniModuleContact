<?php

namespace App\Mail;

use App\Models\DemandeContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationDemande extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * On passe la demande au constructeur pour l'utiliser dans la vue.
     * "public" => automatiquement disponible dans la vue Blade.
     */
    public function __construct(public DemandeContact $demande)
    {
    }

    /** Sujet de l'e-mail */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre demande ' . $this->demande->numero_demande,
        );
    }

    /** Vue Blade utilisée pour le corps du mail */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation-demande',
        );
    }
}