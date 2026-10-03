@extends('layouts.app')

@section('title', 'Suivre ma demande')
@section('body-class', 'page-suivi')

@section('content')
    <div class="page-header">
    @include('partials.back-button', ['route' => route('contact.create'), 'label' => 'Retour au formulaire'])
    <h1>Suivre ma demande</h1>
    <p class="subtitle">Saisissez votre numéro de demande pour connaître son statut.</p>
</div>

    <form method="POST" action="{{ route('suivi.rechercher') }}" class="card form-card" novalidate>
        @csrf

        <div class="field">
            <label for="numero_demande">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Numéro de demande
            </label>
            <input type="text" id="numero_demande" name="numero_demande"
                   value="{{ old('numero_demande', $numero ?? '') }}"
                   placeholder="Ex : DEM-2026-A7K9"
                   class="@error('numero_demande') is-invalid @enderror" required autofocus>
            @error('numero_demande') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Rechercher
        </button>
    </form>

    @isset($demande)
        @if($demande)
            <div class="card result-card">
                <div class="result-header">
                    <h2>Demande {{ $demande->numero_demande }}</h2>
                    @if($demande->statut === 'traitee')
                        <span class="badge badge-success">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Traitée
                        </span>
                    @else
                        <span class="badge badge-warning">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            En attente
                        </span>
                    @endif
                </div>

                <dl class="detail-list">
                    <dt>Nom</dt><dd>{{ $demande->nom }}</dd>
                    <dt>Service</dt><dd>{{ $demande->service->nom ?? '—' }}</dd>
                    <dt>Reçue le</dt><dd>{{ $demande->created_at->format('d/m/Y à H:i') }}</dd>
                    @if($demande->statut === 'traitee')
                        <dt>Traitée le</dt><dd>{{ $demande->updated_at->format('d/m/Y à H:i') }}</dd>
                    @endif
                </dl>

                <div class="detail-message">
                    <strong>Message envoyé</strong>
                    <p>{{ $demande->message }}</p>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="status">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Aucune demande trouvée pour ce numéro. Vérifiez la saisie (ex : <code>DEM-2026-A7K9</code>).</span>
            </div>
        @endif
    @endisset
@endsection