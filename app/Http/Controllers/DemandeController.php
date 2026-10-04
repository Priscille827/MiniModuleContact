<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationDemande;
use App\Mail\NouvelleDemandeAdmin;
use App\Models\Admin;
use App\Models\DemandeContact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    public function create()
    {
        $services = Service::where('actif', true)->orderBy('nom')->get();
        return view('contact', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'        => ['required', 'string', 'max:150'],
            'email'      => ['required', 'email', 'max:255'],
            'id_service' => ['required', 'exists:services,id'],
            'message'    => ['required', 'string', 'max:2000'],
        ], [
            'nom.required'        => 'Le nom est obligatoire.',
            'email.required'      => "L'adresse e-mail est obligatoire.",
            'email.email'         => "L'adresse e-mail n'est pas valide.",
            'id_service.required' => 'Veuillez choisir un service.',
            'id_service.exists'   => 'Le service choisi est invalide.',
            'message.required'    => 'Le message est obligatoire.',
        ]);

        // 1) Numéro + statut
        $validated['numero_demande'] = DemandeContact::genererNumero();
        $validated['statut']         = 'en_attente';

        // 2) Enregistrer en base
        $demande = DemandeContact::create($validated);

        // 3) Confirmation au visiteur
        Mail::to($demande->email)->send(new ConfirmationDemande($demande));

sleep(1);

        // 4) Notification à tous les admins actifs
        $emailsAdmins = Admin::where('actif', true)
            ->pluck('email')
            ->all(); 

        if (! empty($emailsAdmins)) {
    Mail::bcc($emailsAdmins)->send(new NouvelleDemandeAdmin($demande));
}

        return redirect()->route('contact.create')
            ->with('success', ' Votre demande a bien été envoyée. Numéro : ' . $demande->numero_demande);
    }
}