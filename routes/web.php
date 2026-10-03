<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuiviController;

// Public
Route::get('/', [DemandeController::class, 'create'])->name('contact.create');
Route::post('/', [DemandeController::class, 'store'])->name('contact.store');

// Suivi de demande (public)
Route::get('/suivi', [SuiviController::class, 'index'])->name('suivi.index');
Route::post('/suivi', [SuiviController::class, 'rechercher'])->name('suivi.rechercher');

// Admin : login / logout
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin : protégé
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/demandes/{demande}/traite', [AdminController::class, 'marquerTraitee'])
        ->name('admin.demandes.traite');

          // Suppression (soft delete)
    Route::delete('/demandes/{demande}', [AdminController::class, 'supprimer'])
        ->name('admin.demandes.supprimer');

    // Corbeille
    Route::get('/corbeille', [AdminController::class, 'corbeille'])->name('admin.corbeille');
    Route::patch('/corbeille/{id}/restaurer', [AdminController::class, 'restaurer'])
        ->name('admin.corbeille.restaurer');
    Route::delete('/corbeille/{id}', [AdminController::class, 'supprimerDefinitivement'])
        ->name('admin.corbeille.supprimer');
});