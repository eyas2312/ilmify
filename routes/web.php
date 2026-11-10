<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes web d'Ilmify
|--------------------------------------------------------------------------
| Ordre de lecture : public -> authentification -> espace étudiant ->
| espace administrateur. Les règles d'accès sont visibles d'un coup d'œil.
*/

/* ---------- 1. Public ---------- */
Route::view('/', 'landing')->name('home');

/* ---------- 2. Invités uniquement (guest) ---------- */
// Un utilisateur déjà connecté est redirigé vers son tableau de bord.
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    // throttle:6,1 = 6 tentatives par minute et par adresse IP (anti force brute).
    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('login.store');
});

/* ---------- 3. Utilisateurs connectés (auth) ---------- */
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    /*
     | Espace étudiant. Le préfixe /etudiant et le préfixe de nom
     | « student. » sont déclarés une seule fois pour tout le groupe.
     */
    Route::prefix('etudiant')->name('student.')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('/matieres', [SubjectController::class, 'index'])->name('subjects.index');
        Route::get('/matieres/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
    });
});

/* ---------- 4. Administrateurs (auth + admin) ---------- */
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Espace admin : squelette à l'étape 4, complété à l'étape 7.
    Route::view('/', 'admin.dashboard')->name('admin.dashboard');
});

