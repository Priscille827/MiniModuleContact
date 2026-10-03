@extends('layouts.app')

@section('title', 'Demande de contact')
@section('body-class', 'page-contact')

@section('content')
    <div class="page-header">
        <h1>Demande de contact</h1>
        <p class="subtitle">Remplissez le formulaire ci-dessous, nous vous répondrons rapidement.</p>
    </div>

   

    <form method="POST" action="{{ route('contact.store') }}" class="card form-card" novalidate>
        @csrf

        <div class="field">
            <label for="nom">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Nom complet
            </label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}"
                   placeholder="Ex : Awa DOSSOU"
                   class="@error('nom') is-invalid @enderror" required>
            @error('nom') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="email">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Adresse e-mail
            </label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   placeholder="vous@exemple.com"
                   class="@error('email') is-invalid @enderror" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="id_service">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                Service souhaité
            </label>
            <select id="id_service" name="id_service" class="@error('id_service') is-invalid @enderror" required>
                <option value="">— Choisir un service —</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}" @selected(old('id_service') == $s->id)>{{ $s->nom }}</option>
                @endforeach
            </select>
            @error('id_service') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="message">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Message
            </label>
            <textarea id="message" name="message" rows="5"
                      placeholder="Décrivez votre besoin en quelques lignes…"
                      class="@error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
            @error('message') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Envoyer ma demande
        </button>
    </form>
@endsection