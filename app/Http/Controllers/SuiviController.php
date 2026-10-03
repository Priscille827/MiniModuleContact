<?php

namespace App\Http\Controllers;

use App\Models\DemandeContact;
use Illuminate\Http\Request;

class SuiviController extends Controller
{
    /** Affiche le formulaire de suivi */
    public function index()
    {
        return view('suivi');
    }

    /** Recherche une demande par son numéro */
    public function rechercher(Request $request)
    {
        $validated = $request->validate([
            'numero_demande' => ['required', 'string', 'max:30'],
        ], [
            'numero_demande.required' => 'Veuillez saisir votre numéro de demande.',
        ]);

        $demande = DemandeContact::with('service')
            ->where('numero_demande', strtoupper(trim($validated['numero_demande'])))
            ->first();

        return view('suivi', [
            'demande' => $demande,
            'numero'  => $validated['numero_demande'],
        ]);
    }
}