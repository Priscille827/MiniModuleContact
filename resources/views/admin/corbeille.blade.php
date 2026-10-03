@extends('layouts.app')

@section('title', 'Corbeille')
@section('body-class', 'page-dashboard')

@section('content')
    <div class="page-header">
        @include('partials.back-button', ['route' => route('admin.dashboard'), 'label' => 'Retour au tableau de bord'])
        <h1>Corbeille</h1>
        <p class="subtitle">Demandes supprimées récemment.</p>
    </div>

    <section class="card table-card">
        @if($demandes->isEmpty())
            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                <p>La corbeille est vide.</p>
            </div>
        @else
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>N° demande</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Supprimée le</th>
                            <th class="ta-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $d)
                            <tr class="row-deleted">
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
                                <td data-label="Supprimée le" class="ta-nowrap">
                                    {{ $d->deleted_at->format('d/m/Y H:i') }}
                                </td>
                                <td data-label="Actions" class="ta-right">
                                    <form method="POST"
                                          action="{{ route('admin.corbeille.restaurer', $d->id) }}"
                                          class="inline-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-icon btn-success" title="Restaurer">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                                        </button>
                                    </form>

                                    <button type="button"
                                            class="btn btn-icon btn-danger btn-confirm-force-delete"
                                            data-action="{{ route('admin.corbeille.supprimer', $d->id) }}"
                                            data-numero="{{ $d->numero_demande }}"
                                            title="Supprimer définitivement">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
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
                    Affichage de <strong>{{ $demandes->firstItem() }}</strong>
                    à <strong>{{ $demandes->lastItem() }}</strong>
                    sur <strong>{{ $demandes->total() }}</strong>
                    demande{{ $demandes->total() > 1 ? 's' : '' }} supprimée{{ $demandes->total() > 1 ? 's' : '' }}
                </div>

                @if($demandes->hasPages())
                    <nav class="pagination" role="navigation" aria-label="Pagination">
                        @if($demandes->onFirstPage())
                            <span class="page-link disabled">Précédent</span>
                        @else
                            <a href="{{ $demandes->previousPageUrl() }}" class="page-link" rel="prev">Précédent</a>
                        @endif

                        @foreach($demandes->getUrlRange(max(1, $demandes->currentPage() - 2), min($demandes->lastPage(), $demandes->currentPage() + 2)) as $page => $url)
                            @if($page == $demandes->currentPage())
                                <span class="page-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($demandes->hasMorePages())
                            <a href="{{ $demandes->nextPageUrl() }}" class="page-link" rel="next">Suivant</a>
                        @else
                            <span class="page-link disabled">Suivant</span>
                        @endif
                    </nav>
                @endif
            </div>
        @endif
    </section>

    {{-- Modale de suppression définitive --}}
    <div class="modal" id="modal-force-delete" hidden>
        <div class="modal-overlay" data-close-force></div>
        <div class="modal-content card modal-confirm" role="dialog" aria-modal="true">
            <div class="modal-header">
                <h2>Suppression définitive</h2>
                <button type="button" class="btn btn-icon btn-ghost" data-close-force title="Fermer">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="confirm-icon confirm-icon-danger">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <p>Voulez-vous vraiment supprimer <strong>définitivement</strong> la demande <strong id="force-numero"></strong> ?</p>
                <p class="muted">Cette action est irréversible.</p>

                <div class="confirm-actions">
                    <button type="button" class="btn btn-ghost" data-close-force>Annuler</button>
                    <form method="POST" id="form-force-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            Supprimer définitivement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const modalForce = document.getElementById('modal-force-delete');
    const formForce  = document.getElementById('form-force-delete');

    document.querySelectorAll('.btn-confirm-force-delete').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.getElementById('force-numero').textContent = btn.dataset.numero;
            formForce.action = btn.dataset.action;
            modalForce.hidden = false;
        });
    });

    modalForce.querySelectorAll('[data-close-force]').forEach((el) => {
        el.addEventListener('click', () => modalForce.hidden = true);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') modalForce.hidden = true;
    });
</script>
@endpush