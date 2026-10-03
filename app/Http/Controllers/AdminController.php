<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DemandeContact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemandeTraitee;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => "L'e-mail est obligatoire.",
            'email.email'       => "L'e-mail n'est pas valide.",
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        // Récupération manuelle car le champ s'appelle "mot_de_passe"
        $admin = Admin::where('email', $credentials['email'])
                      ->where('actif', true)
                      ->first();

        if (! $admin || ! Hash::check($credentials['password'], $admin->mot_de_passe)) {
            return back()
                ->withErrors(['email' => 'Identifiants incorrects.'])
                ->onlyInput('email');
        }

        // Connexion manuelle via le guard admin
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        $admin->update(['derniere_connexion' => now()]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    

   
    public function marquerTraitee(DemandeContact $demande)
    {
        // 1) Mettre à jour le statut
        $demande->update(['statut' => 'traitee']);

        // 2) Envoyer l'e-mail au visiteur
        Mail::to($demande->email)->send(new DemandeTraitee($demande));

        return back()->with('success', 'Demande marquée comme traitée et e-mail envoyé.');
    }

 public function dashboard(Request $request)
{
    $filtre       = $request->query('service');
    $statutFiltre = $request->query('statut');
    $recherche    = $request->query('q');   // ← nouveau

    $demandes = DemandeContact::with('service')
        ->when($recherche, function ($q) use ($recherche) {
            $q->where(function ($sub) use ($recherche) {
                $sub->where('nom', 'like', "%{$recherche}%")
                    ->orWhere('email', 'like', "%{$recherche}%")
                    ->orWhere('numero_demande', 'like', "%{$recherche}%");
            });
        })
        ->when($filtre,       fn ($q) => $q->where('id_service', $filtre))
        ->when($statutFiltre, fn ($q) => $q->where('statut', $statutFiltre))
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    $stats = [
        'total'      => DemandeContact::count(),
        'en_attente' => DemandeContact::where('statut', 'en_attente')->count(),
        'traitee'    => DemandeContact::where('statut', 'traitee')->count(),
        'services'   => Service::where('actif', true)->count(),
    ];

    $services = Service::orderBy('nom')->get();

    return view('admin.dashboard', compact(
        'demandes', 'services', 'filtre', 'statutFiltre', 'recherche', 'stats'
    ));
}

/**
 * Supprime (soft delete) une demande.
 * Elle part dans la corbeille.
 */
public function supprimer(DemandeContact $demande)
{
    $demande->delete(); // soft delete
    return back()->with('success', 'Demande déplacée dans la corbeille.');
}

/**
 * Affiche la corbeille (demandes supprimées).
 */
public function corbeille()
{
    $demandes = DemandeContact::onlyTrashed()
        ->with('service')
        ->orderByDesc('deleted_at')
        ->paginate(10);

    return view('admin.corbeille', compact('demandes'));
}

/**
 * Restaure une demande supprimée.
 */
public function restaurer($id)
{
    $demande = DemandeContact::onlyTrashed()->findOrFail($id);
    $demande->restore();

    return back()->with('success', 'Demande restaurée avec succès.');
}

/**
 * Supprime définitivement une demande (hard delete).
 */
public function supprimerDefinitivement($id)
{
    $demande = DemandeContact::onlyTrashed()->findOrFail($id);
    $demande->forceDelete();

    return back()->with('success', 'Demande supprimée définitivement.');
}

}