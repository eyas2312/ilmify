@extends('layouts.guest')

@section('title', 'Créer un compte — Ilmify')

@section('auth-content')
    <div class="auth-head">
        <span class="pill pill--accent">Inscription</span>
        <h1>Créer un compte étudiant</h1>
        <p class="text-muted-2">Quelques secondes suffisent pour commencer à réviser.</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Eya Souey"
                   autocomplete="name"
                   required
                   autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="prenom@exemple.com"
                   autocomplete="username"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row g-3 mb-3">
            <div class="col-sm-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="8 caractères minimum"
                       autocomplete="new-password"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-6">
                <label for="password_confirmation" class="form-label">Confirmation</label>
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Répète le mot de passe"
                       autocomplete="new-password"
                       required>
            </div>
        </div>

        <p class="auth-note">
            <i class="bi bi-shield-check me-1"></i>
            Le mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre.
        </p>

        <button type="submit" class="btn btn-brand w-100 mb-3">
            Créer mon compte <i class="bi bi-arrow-right ms-1"></i>
        </button>

        <p class="text-center small mb-0 text-muted-2">
            Déjà inscrit ? <a href="{{ route('login') }}" class="auth-link">Se connecter</a>
        </p>
    </form>
@endsection
