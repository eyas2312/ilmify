@extends('layouts.guest')

@section('title', 'Connexion — Ilmify')

@section('auth-content')
    <div class="auth-head">
        <span class="pill pill--accent">Connexion</span>
        <h1>Content de te revoir</h1>
        <p class="text-muted-2">Entre tes identifiants pour retrouver ta progression.</p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" novalidate>
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="prenom@exemple.com"
                   autocomplete="username"
                   required
                   autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••"
                   autocomplete="current-password"
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1" @checked(old('remember'))>
                <label class="form-check-label small" for="remember">Rester connecté</label>
            </div>
            <a href="{{ route('register') }}" class="auth-link small">Créer un compte</a>
        </div>

        <button type="submit" class="btn btn-brand w-100">
            Se connecter <i class="bi bi-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="auth-hint">
        <strong><i class="bi bi-info-circle me-1"></i>Comptes de démonstration</strong>
        <span>Étudiant : <code>eya@ilmify.test</code></span>
        <span>Admin : <code>admin@ilmify.test</code></span>
        <span>Mot de passe : <code>password</code></span>
    </div>
@endsection
