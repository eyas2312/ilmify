@extends('layouts.base')

@section('title', 'Administration — Ilmify')

@section('content')
<header class="app-bar app-bar--deep">
    <div class="container d-flex align-items-center justify-content-between gap-3">
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            Ilmify
        </a>

        <div class="d-flex align-items-center gap-3">
            <span class="pill" style="background: rgba(255,255,255,.12); color:#dbe5ee;">Administration</span>
            <span class="avatar avatar--deep" title="{{ auth()->user()->name }}">{{ auth()->user()->initials() }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                </button>
            </form>
        </div>
    </div>
</header>

<main class="container py-5" style="max-width: 780px;">
    @include('partials.flash')

    <div class="surface p-4 p-md-5">
        <span class="pill pill--plain">Tableau de bord</span>
        <h1 class="mt-3 mb-2">Bonjour {{ auth()->user()->name }}</h1>
        <p class="mb-4">
            Tu es connecté avec le rôle <strong>administrateur</strong>
            (<code>{{ auth()->user()->email }}</code>).
            La gestion des matières, chapitres, cours, quiz et étudiants arrive à l'étape 7.
        </p>

        <div class="d-flex flex-wrap gap-3">
            <div class="kpi kpi--wide">
                <small>Étudiants inscrits</small>
                <b>{{ \App\Models\User::students()->count() }}</b>
            </div>
            <div class="kpi kpi--wide">
                <small>Matières</small>
                <b>{{ \App\Models\Subject::count() }}</b>
            </div>
        </div>
    </div>

    <p class="text-muted-2 small mt-4 mb-0">
        <i class="bi bi-info-circle me-1"></i>
        Cette page est provisoire : elle sert à vérifier la protection de l'espace admin.
    </p>
</main>
@endsection
