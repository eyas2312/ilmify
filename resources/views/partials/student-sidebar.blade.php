{{--
    Sidebar de l'espace étudiant.
    Grâce aux classes Bootstrap 5.3 « offcanvas-lg offcanvas-start », le même
    balisage sert de menu coulissant sous 992px et de colonne fixe au-dessus :
    aucun JavaScript personnalisé n'est nécessaire.
--}}
<aside class="app-sidebar offcanvas-lg offcanvas-start" tabindex="-1"
       id="studentSidebar" aria-labelledby="studentSidebarLabel">
    <div class="offcanvas-header d-lg-none">
        <span class="brand" id="studentSidebarLabel">
            <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            Ilmify
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                data-bs-target="#studentSidebar" aria-label="Fermer le menu"></button>
    </div>

    <div class="app-sidebar-inner">
        <a class="brand app-sidebar-brand d-none d-lg-inline-flex" href="{{ route('student.dashboard') }}">
            <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            Ilmify
        </a>

        <div>
            <p class="app-nav-label">Apprendre</p>
            <nav class="app-nav" aria-label="Navigation de l'espace étudiant">
                <a class="app-nav-link {{ request()->routeIs('student.dashboard') ? 'is-active' : '' }}"
                   href="{{ route('student.dashboard') }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Tableau de bord</span>
                </a>
                <a class="app-nav-link {{ request()->routeIs('student.subjects.*') ? 'is-active' : '' }}"
                   href="{{ route('student.subjects.index') }}">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Matières</span>
                </a>
                <span class="app-nav-link is-disabled" aria-disabled="true">
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Mes résultats</span>
                    <span class="app-nav-badge">Bientôt</span>
                </span>
            </nav>
        </div>

        <div class="app-sidebar-note">
            <i class="bi bi-lightbulb"></i>
            <p>Réviser un peu chaque jour vaut mieux que tout relire la veille.</p>
        </div>

        <div class="app-sidebar-foot">
            <div class="d-flex align-items-center gap-2">
                <span class="avatar">{{ auth()->user()->initials() }}</span>
                <div class="lh-sm overflow-hidden">
                    <div class="app-topbar-user">{{ auth()->user()->name }}</div>
                    <div class="app-topbar-mail">Étudiant</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="app-sidebar-logout">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>
</aside>
