<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Benin Digital Hub')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="@yield('body-class')">

<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('contact.create') }}" class="brand">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0"/>
                <path d="M12 3v9l6 3"/>
            </svg>
            <span>Benin Digital Hub</span>
        </a>

        <nav class="main-nav">
    @auth('admin')
        {{-- Admin connecté --}}
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
            Tableau de bord
        </a>
        <a href="{{ route('admin.corbeille') }}" class="nav-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
            Corbeille
        </a>
        <form method="POST" action="{{ route('admin.logout') }}" class="inline-form">
            @csrf
            <button type="submit" class="nav-link nav-link-danger">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Déconnexion
            </button>
        </form>
    @else
        {{-- Visiteur (non connecté) --}}
        @unless(request()->routeIs('suivi.*'))
            <a href="{{ route('suivi.index') }}" class="nav-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Suivre ma demande
            </a>
        @endunless

        @unless(request()->routeIs('contact.*'))
            <a href="{{ route('contact.create') }}" class="nav-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Nouvelle demande
            </a>
        @endunless

        <a href="{{ route('admin.login') }}" class="nav-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Espace admin
        </a>
    @endauth
</nav>
    </div>
</header>

<main class="site-main">
    <div class="container">

        {{-- ═══════════════════════════════════════════════
             Alerte globale auto-fermable (20 s)
             Centralisée ici → supprimée de toutes les vues
             ═══════════════════════════════════════════════ --}}
        @if(session('success'))
            <div class="alert alert-success" role="status" data-auto-dismiss>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <span>{{ session('success') }}</span>
                <button type="button" class="alert-close" data-dismiss aria-label="Fermer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-warning" role="status" data-auto-dismiss>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span>{{ session('error') }}</span>
                <button type="button" class="alert-close" data-dismiss aria-label="Fermer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<footer class="site-footer">
    <div class="container">
        <p>© {{ date('Y') }} Benin Digital Hub — Tous droits réservés.</p>
    </div>
</footer>

<script>
    /* ---------- Alerte auto-fermable (20 s) ---------- */
    document.querySelectorAll('.alert[data-auto-dismiss]').forEach((alert) => {
        const timer = setTimeout(() => alert.remove(), 20000);

        const closeBtn = alert.querySelector('[data-dismiss]');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                clearTimeout(timer);
                alert.remove();
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>