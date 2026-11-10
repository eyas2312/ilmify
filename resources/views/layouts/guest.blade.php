<!DOCTYPE html>
{{-- Layout des pages publiques d'authentification : connexion / inscription.
     Deux colonnes : le panneau de marque (gauche) et le formulaire (droite).
     Il hérite de base.blade.php pour les CDN et la feuille de style. --}}
@extends('layouts.base')

@section('body-class', 'auth-body')

@section('content')
<div class="auth-shell">

    {{-- Colonne gauche : identité visuelle (masquée sur mobile) --}}
    <aside class="auth-side">
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            Ilmify
        </a>

        <div class="auth-side-body">
            <h2>Réviser avec méthode,<br>progresser avec preuves.</h2>
            <p>Cours, quiz corrigés automatiquement et statistiques de progression, réunis dans un seul espace.</p>

            <ul class="auth-points">
                <li><i class="bi bi-check2-circle"></i> Des quiz corrigés à l'instant</li>
                <li><i class="bi bi-check2-circle"></i> Une progression visible par matière</li>
                <li><i class="bi bi-check2-circle"></i> Des explications pour chaque réponse</li>
            </ul>
        </div>

        <p class="auth-side-foot">Projet MDW3 — Souhail Saidi &amp; Eya Souey</p>
    </aside>

    {{-- Colonne droite : le formulaire --}}
    <main class="auth-main">
        <div class="auth-card">
            @yield('auth-content')
        </div>

        <p class="auth-back">
            <a href="{{ route('home') }}"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
        </p>
    </main>

</div>
@endsection
