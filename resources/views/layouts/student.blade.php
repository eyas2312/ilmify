@extends('layouts.base')

{{-- Ce layout est la coquille commune des pages étudiantes : sidebar à gauche,
     barre supérieure avec le titre de la page, puis le contenu. --}}

@section('body-class', 'app-body')

@section('content')
<div class="app-shell">

    @include('partials.student-sidebar')

    <div class="app-main">
        <header class="app-topbar">
            <div class="d-flex align-items-center gap-2 gap-sm-3">
                {{-- Sur mobile, la sidebar devient un panneau coulissant (offcanvas). --}}
                <button class="app-burger d-lg-none" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#studentSidebar"
                        aria-controls="studentSidebar" aria-label="Ouvrir le menu">
                    <i class="bi bi-list"></i>
                </button>

                <div>
                    <p class="app-topbar-eyebrow">@yield('eyebrow', 'Espace étudiant')</p>
                    <h1 class="app-topbar-title">@yield('page-title', 'Tableau de bord')</h1>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 gap-sm-3">
                <div class="d-none d-sm-block text-end lh-sm">
                    <div class="app-topbar-user">{{ auth()->user()->name }}</div>
                    <div class="app-topbar-mail">{{ auth()->user()->email }}</div>
                </div>
                <span class="avatar" title="{{ auth()->user()->name }}">{{ auth()->user()->initials() }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm" title="Se déconnecter">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="d-none d-md-inline ms-1">Déconnexion</span>
                    </button>
                </form>
            </div>
        </header>

        <main class="app-content">
            @include('partials.flash')
            {{-- Deuxième niveau de gabarit : les pages étudiantes remplissent
                 la section « page », pas « content » (déjà utilisée ici pour
                 construire la coquille au-dessus du layout base). --}}
            @yield('page')
        </main>
    </div>
</div>
@endsection
