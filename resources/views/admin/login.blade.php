@extends('layouts.app')

@section('title', 'Connexion admin')
@section('body-class', 'page-login')

@section('content')
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="auth-header">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <h1>Espace administrateur</h1>
                <p class="subtitle">Connectez-vous pour gérer les demandes.</p>
            </div>

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                <div class="field">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="admin@exemple.com"
                           class="@error('email') is-invalid @enderror" required autofocus>
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           class="@error('password') is-invalid @enderror" required>
                    @error('password') <p class="error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Se connecter
                </button>
            </form>
        </div>
    </div>
@endsection