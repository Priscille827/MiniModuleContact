@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('body-class', 'page-dashboard')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tableau de bord</h1>
            <p class="subtitle">Suivi des demandes de contact reçues.</p>
        </div>
    </div>

    {{-- Cartes récapitulatives --}}
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="stat-body">
                <span class="stat-label">Total demandes</span>
                <span class="stat-value">{{ $stats['total'] }}</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-orange">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-body">
                <span class="stat-label">En attente</span>
                <span class="stat-value">{{ $stats['en_attente'] }}</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div class="stat-body">
                <span class="stat-label">Traitées</span>
                <span class="stat-value">{{ $stats['traitee'] }}</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-purple">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
            </div>
            <div class="stat-body">
                <span class="stat-label">Services actifs</span>
                <span class="stat-value">{{ $stats['services'] }}</span>
            </div>
        </div>
    </section>

    {{-- Filtres + recherche --}}
    <section class="card filter-card">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="filters">
            <div class="filter-group filter-search">
                <label for="q">Recherche</label>
                <div class="search-input">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="q" name="q" value="{{ $recherche }}"
                           placeholder="Nom, e-mail ou n° de demande…">
                </div>
            </div>

            <div class="filter-group">
                <label for="service">Service</label>
                <select name="service" id="service" onchange="this.form.submit()">
                    <option value="">Tous les services</option>
                    @foreach($services as $s)
                        <option value="{{ $s->id }}" @selected($filtre == $s->id)>{{ $s->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" onchange="this.form.submit()">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" @selected($statutFiltre === 'en_attente')>En attente</option>
                    <option value="traitee" @selected($statutFiltre === 'traitee')>Traitée</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Filtrer
            </button>

            @if($filtre || $statutFiltre || $recherche)
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    Réinitialiser
                </a>
            @endif
        </form>
    </section>

    {{-- Tableau --}}
    <section class="card table-card">
        @if($demandes->isEmpty())
            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <p>Aucune demande à afficher.</p>
            </div>
        @else
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>N° demande</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th class="ta-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $d)
                            <tr class="{{ $d->statut === 'traitee' ? 'row-traitee' : '' }}">
                                <td data-label="N° demande">
                                    <code class="code-badge">{{ $d->numero_demande }}</code>
                                </td>
                                <td data-label="Contact">
                                    <div class="cell-contact">
                                        <strong>{{ $d->nom }}</strong>
                                        <a href="mailto:{{ $d->email }}">{{ $d->email }}</a>
                                    </div>
                                </td>
                                <td data-label="Service">{{ $d->service->nom ?? '—' }}</td>
                                <td data-label="Statut">
                                    @if($d->statut === 'traitee')
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
                                </td>
                                <td data-label="Date" class="ta-nowrap">
                                    {{ $d->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td data-label="Action" class="ta-right">
                                    {{-- Voir détail --}}
                                    <button type="button"
                                            class="btn btn-icon btn-details"
                                            data-numero="{{ $d->numero_demande }}"
                                            data-nom="{{ $d->nom }}"
                                            data-email="{{ $d->email }}"
                                            data-service="{{ $d->service->nom ?? '—' }}"
                                            data-message="{{ $d->message }}"
                                            data-date="{{ $d->created_at->format('d/m/Y à H:i') }}"
                                            title="Voir le détail">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>

                                    {{-- Marquer comme traitée --}}
                                    @if($d->statut === 'en_attente')
                                        <button type="button"
                                                class="btn btn-icon btn-success btn-confirm-traite"
                                                data-action="{{ route('admin.demandes.traite', $d) }}"
                                                data-numero="{{ $d->numero_demande }}"
                                                title="Marquer comme traitée">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        </button>
                                    @endif

                                    {{-- Supprimer --}}
                                    <button type="button"
                                            class="btn btn-icon btn-danger btn-confirm-delete"
                                            data-action="{{ route('admin.demandes.supprimer', $d) }}"
                                            data-numero="{{ $d->numero_demande }}"
                                            title="Supprimer">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Affichage de
                    <strong>{{ $demandes->firstItem() }}</strong>
                    à
                    <strong>{{ $demandes->lastItem() }}</strong>
                    sur
                    <strong>{{ $demandes->total() }}</strong>
                    demande{{ $demandes->total() > 1 ? 's' : '' }}
                </div>

                @if($demandes->hasPages())
                    <nav class="pagination" role="navigation" aria-label="Pagination">
                        {{-- Précédent --}}
                        @if($demandes->onFirstPage())
                            <span class="page-link disabled" aria-disabled="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                                Précédent
                            </span>
                        @else
                            <a href="{{ $demandes->previousPageUrl() }}" class="page-link" rel="prev">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                                Précédent
                            </a>
                        @endif

                        {{-- Numéros de page (fenêtre glissante de 5) --}}
                        @foreach($demandes->getUrlRange(max(1, $demandes->currentPage() - 2), min($demandes->lastPage(), $demandes->currentPage() + 2)) as $page => $url)
                            @if($page == $demandes->currentPage())
                                <span class="page-link active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Suivant --}}
                        @if($demandes->hasMorePages())
                            <a href="{{ $demandes->nextPageUrl() }}" class="page-link" rel="next">
                                Suivant
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        @else
                            <span class="page-link disabled" aria-disabled="true">
                                Suivant
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </span>
                        @endif
                    </nav>
                @endif
            </div>
        @endif
    </section>

    {{-- ═══════════════════════════════════════════════
         Modale 1 : Détail de la demande
         ═══════════════════════════════════════════════ --}}
    <div class="modal" id="modal-detail" hidden>
        <div class="modal-overlay" data-close-detail></div>
        <div class="modal-content card" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="modal-header">
                <h2 id="modal-title">Détail de la demande</h2>
                <button type="button" class="btn btn-icon btn-ghost" data-close-detail title="Fermer">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <dl class="detail-list">
                    <dt>Numéro</dt><dd id="d-numero"></dd>
                    <dt>Nom</dt><dd id="d-nom"></dd>
                    <dt>E-mail</dt><dd><a id="d-email" href="#"></a></dd>
                    <dt>Service</dt><dd id="d-service"></dd>
                    <dt>Reçue le</dt><dd id="d-date"></dd>
                </dl>
                <div class="detail-message">
                    <strong>Message</strong>
                    <p id="d-message"></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         Modale 2 : Confirmation de traitement
         ═══════════════════════════════════════════════ --}}
    <div class="modal" id="modal-confirm" hidden>
        <div class="modal-overlay" data-close-confirm></div>
        <div class="modal-content card modal-confirm" role="dialog" aria-modal="true" aria-labelledby="confirm-title">
            <div class="modal-header">
                <h2 id="confirm-title">Confirmer le traitement</h2>
                <button type="button" class="btn btn-icon btn-ghost" data-close-confirm title="Fermer">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="confirm-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <p>Voulez-vous vraiment marquer la demande <strong id="confirm-numero"></strong> comme <strong>traitée</strong> ?</p>
                <p class="muted">Un e-mail sera automatiquement envoyé au visiteur.</p>

                <div class="confirm-actions">
                    <button type="button" class="btn btn-ghost" data-close-confirm>Annuler</button>
                    <form method="POST" id="form-traite">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Oui, marquer comme traitée
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         Modale 3 : Confirmation de suppression
         ═══════════════════════════════════════════════ --}}
    <div class="modal" id="modal-delete" hidden>
        <div class="modal-overlay" data-close-delete></div>
        <div class="modal-content card modal-confirm" role="dialog" aria-modal="true" aria-labelledby="delete-title">
            <div class="modal-header">
                <h2 id="delete-title">Confirmer la suppression</h2>
                <button type="button" class="btn btn-icon btn-ghost" data-close-delete title="Fermer">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="confirm-icon confirm-icon-danger">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </div>
                <p>Voulez-vous vraiment supprimer la demande <strong id="delete-numero"></strong> ?</p>
                <p class="muted">Elle sera placée dans la corbeille et pourra être restaurée.</p>

                <div class="confirm-actions">
                    <button type="button" class="btn btn-ghost" data-close-delete>Annuler</button>
                    <form method="POST" id="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            Oui, supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    /* ═══════════════════════════════════════════════
       Modale 1 : Détail
       ═══════════════════════════════════════════════ */
    const modalDetail = document.getElementById('modal-detail');

    document.querySelectorAll('.btn-details').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.getElementById('d-numero').textContent  = btn.dataset.numero;
            document.getElementById('d-nom').textContent     = btn.dataset.nom;
            document.getElementById('d-service').textContent = btn.dataset.service;
            document.getElementById('d-date').textContent    = btn.dataset.date;
            document.getElementById('d-message').textContent = btn.dataset.message;

            const emailEl = document.getElementById('d-email');
            emailEl.textContent = btn.dataset.email;
            emailEl.href = 'mailto:' + btn.dataset.email;

            modalDetail.hidden = false;
        });
    });

    modalDetail.querySelectorAll('[data-close-detail]').forEach((el) => {
        el.addEventListener('click', () => modalDetail.hidden = true);
    });

    /* ═══════════════════════════════════════════════
       Modale 2 : Confirmation de traitement
       ═══════════════════════════════════════════════ */
    const modalConfirm = document.getElementById('modal-confirm');
    const formTraite   = document.getElementById('form-traite');

    document.querySelectorAll('.btn-confirm-traite').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.getElementById('confirm-numero').textContent = btn.dataset.numero;
            formTraite.action = btn.dataset.action;
            modalConfirm.hidden = false;
        });
    });

    modalConfirm.querySelectorAll('[data-close-confirm]').forEach((el) => {
        el.addEventListener('click', () => modalConfirm.hidden = true);
    });

    /* ═══════════════════════════════════════════════
       Modale 3 : Confirmation de suppression
       ═══════════════════════════════════════════════ */
    const modalDelete = document.getElementById('modal-delete');
    const formDelete  = document.getElementById('form-delete');

    document.querySelectorAll('.btn-confirm-delete').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.getElementById('delete-numero').textContent = btn.dataset.numero;
            formDelete.action = btn.dataset.action;
            modalDelete.hidden = false;
        });
    });

    modalDelete.querySelectorAll('[data-close-delete]').forEach((el) => {
        el.addEventListener('click', () => modalDelete.hidden = true);
    });

    /* ═══════════════════════════════════════════════
       Fermeture au clavier (Escape)
       ═══════════════════════════════════════════════ */
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            modalDetail.hidden  = true;
            modalConfirm.hidden = true;
            modalDelete.hidden  = true;
        }
    });
</script>
@endpush