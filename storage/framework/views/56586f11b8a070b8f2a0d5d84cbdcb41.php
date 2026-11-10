<?php $__env->startSection('title', 'Ilmify — Réviser, progresser, réussir'); ?>

<?php $__env->startSection('body-class', 'landing'); ?>

<?php $__env->startSection('content'); ?>

    
    <header class="site-nav">
        <nav class="navbar navbar-expand-lg container py-2">
            <a class="brand" href="<?php echo e(url('/')); ?>">
                <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
                Ilmify
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navPublic" aria-controls="navPublic" aria-expanded="false"
                    aria-label="Ouvrir le menu">
                <i class="bi bi-list fs-3"></i>
            </button>

            <div class="collapse navbar-collapse" id="navPublic">
                <ul class="navbar-nav mx-auto gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="#features">Fonctionnalités</a></li>
                    <li class="nav-item"><a class="nav-link" href="#espaces">Espaces</a></li>
                    <li class="nav-item"><a class="nav-link" href="#parcours">Comment ça marche</a></li>
                </ul>
                <div class="d-flex flex-column flex-lg-row gap-2 pt-3 pt-lg-0">
                    <a href="<?php echo e(url('/login')); ?>" class="btn btn-ghost">Connexion</a>
                    <a href="<?php echo e(url('/register')); ?>" class="btn btn-brand">Commencer</a>
                </div>
            </div>
        </nav>
    </header>

    
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="pill mb-3"><i class="bi bi-stars"></i> Projet MDW3 · Laravel &amp; MySQL</span>

                    <h1>
                        Révisez mieux,<br>
                        <span class="text-gradient">progressez vraiment.</span>
                    </h1>

                    <p class="hero-lead">
                        Ilmify organise vos matières, vos cours et vos quiz au même endroit.
                        Chaque tentative est corrigée automatiquement et transformée en
                        statistiques claires pour savoir quoi réviser ensuite.
                    </p>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="<?php echo e(url('/register')); ?>" class="btn btn-brand btn-lg">
                            Créer mon compte <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <a href="#espaces" class="btn btn-ghost btn-lg">
                            <i class="bi bi-play-circle me-1"></i> Découvrir la plateforme
                        </a>
                    </div>

                    <div class="hero-stats">
                        <div class="hero-stat">
                            <strong>Quiz</strong>
                            <span>corrigés instantanément</span>
                        </div>
                        <div class="hero-stat">
                            <strong>Progression</strong>
                            <span>par matière et chapitre</span>
                        </div>
                        <div class="hero-stat">
                            <strong>2 espaces</strong>
                            <span>étudiant &amp; administrateur</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    
                    <div class="hero-art">
                        <div class="mock">
                            <div class="mock-top">
                                <span class="dot"></span><span class="dot"></span><span class="dot"></span>
                                <span class="mock-title">Mon tableau de bord</span>
                            </div>

                            <div class="mock-grid">
                                <div class="ring" style="--value: 72"><span>72%</span></div>
                                <div class="mock-kpis">
                                    <div class="kpi"><small>Quiz réussis</small><b>14 / 19</b></div>
                                    <div class="kpi"><small>Moyenne</small><b>13,8</b></div>
                                    <div class="kpi"><small>Matières</small><b>4</b></div>
                                    <div class="kpi"><small>Série</small><b>6 jours</b></div>
                                </div>
                            </div>

                            <div class="mock-bars">
                                <i style="height: 46%"></i>
                                <i style="height: 64%"></i>
                                <i style="height: 38%"></i>
                                <i style="height: 82%"></i>
                                <i style="height: 58%"></i>
                                <i style="height: 92%"></i>
                                <i style="height: 70%"></i>
                            </div>
                            <div class="mock-line">
                                <span>Semaine dernière</span>
                                <span>Cette semaine</span>
                            </div>

                            <div class="mt-3">
                                <div class="mock-line mb-1">
                                    <span>Algorithmique · Chapitre 3</span><span>82%</span>
                                </div>
                                <div class="progress-thin"><span style="width: 82%"></span></div>
                            </div>
                        </div>

                        <div class="float-card float-card--1">
                            <i class="bi bi-check2-circle"></i> Quiz terminé · 8/10
                        </div>
                        <div class="float-card float-card--2">
                            <i class="bi bi-graph-up-arrow"></i> +12% cette semaine
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section section--tint" id="features">
        <div class="container">
            <div class="section-head" data-reveal>
                <span class="pill pill--accent mb-2"><i class="bi bi-grid"></i> Fonctionnalités</span>
                <h2>Tout ce qu'il faut pour réviser sereinement</h2>
                <p>Un contenu pédagogique structuré, des quiz corrigés côté serveur et un suivi mesurable de vos efforts.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-reveal>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-diagram-3"></i></div>
                        <h3>Cours structurés</h3>
                        <p>Matières, chapitres et cours hiérarchisés : vous retrouvez chaque ressource en deux clics.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-reveal>
                    <div class="feature-card">
                        <div class="feature-icon feature-icon--accent"><i class="bi bi-patch-question"></i></div>
                        <h3>Quiz interactifs</h3>
                        <p>Des questions à choix unique, une seule tentative par question, et un chronomètre d'affichage.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-reveal>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-clipboard-check"></i></div>
                        <h3>Correction automatique</h3>
                        <p>Score calculé côté serveur, bonnes et mauvaises réponses mises en évidence, explications associées.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-reveal>
                    <div class="feature-card">
                        <div class="feature-icon feature-icon--accent"><i class="bi bi-bar-chart-line"></i></div>
                        <h3>Statistiques visuelles</h3>
                        <p>Des graphiques Chart.js pour visualiser votre progression par matière et par chapitre.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-reveal>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-clock-history"></i></div>
                        <h3>Historique complet</h3>
                        <p>Chaque tentative est conservée : date, score, durée. Vous pouvez refaire un quiz à tout moment.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-reveal>
                    <div class="feature-card">
                        <div class="feature-icon feature-icon--accent"><i class="bi bi-shield-lock"></i></div>
                        <h3>Espace administrateur</h3>
                        <p>CRUD complet du contenu, gestion des étudiants et consultation des résultats, protégés par un rôle.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section" id="espaces">
        <div class="container">
            <div class="section-head" data-reveal>
                <span class="pill mb-2"><i class="bi bi-people"></i> Deux espaces</span>
                <h2>Une plateforme, deux expériences</h2>
                <p>L'interface s'adapte automatiquement au rôle du compte connecté. Aucun mélange de droits.</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-6" data-reveal>
                    <div class="role-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="pill"><i class="bi bi-mortarboard"></i> Espace étudiant</span>
                            <i class="bi bi-person-badge fs-4 text-muted-2"></i>
                        </div>
                        <h3 class="h4">Apprendre et mesurer ses progrès</h3>
                        <p class="mb-0">Un tableau de bord personnel, des cartes de matières et des indicateurs de progression.</p>
                        <ul class="role-list">
                            <li><i class="bi bi-check2"></i> Consulter les matières, chapitres et cours</li>
                            <li><i class="bi bi-check2"></i> Passer un quiz et obtenir son score immédiatement</li>
                            <li><i class="bi bi-check2"></i> Revoir chaque réponse avec son explication</li>
                            <li><i class="bi bi-check2"></i> Suivre son historique et ses statistiques</li>
                            <li><i class="bi bi-check2"></i> Refaire un quiz pour s'améliorer</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6" data-reveal>
                    <div class="role-card role-card--admin">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="pill pill--accent"><i class="bi bi-sliders"></i> Espace administrateur</span>
                            <i class="bi bi-shield-check fs-4" style="color:#a9c2d6"></i>
                        </div>
                        <h3 class="h4">Créer et piloter le contenu</h3>
                        <p class="mb-0">Une interface dense et outillée pour gérer l'ensemble de la base pédagogique.</p>
                        <ul class="role-list">
                            <li><i class="bi bi-check2"></i> CRUD des matières, chapitres et cours</li>
                            <li><i class="bi bi-check2"></i> CRUD des quiz, questions et réponses</li>
                            <li><i class="bi bi-check2"></i> Gestion des comptes étudiants</li>
                            <li><i class="bi bi-check2"></i> Consultation des résultats par étudiant et par quiz</li>
                            <li><i class="bi bi-check2"></i> Vue globale de l'activité de la plateforme</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section section--tint" id="parcours">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5" data-reveal>
                    <div class="section-head mb-0">
                        <span class="pill pill--plain mb-2"><i class="bi bi-signpost-split"></i> Parcours</span>
                        <h2>Quatre étapes, un apprentissage régulier</h2>
                        <p>Le cycle est volontairement court : lire, s'auto-évaluer, comprendre ses erreurs, recommencer.</p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="step" data-reveal>
                        <span class="step-num">1</span>
                        <h3>Choisir une matière</h3>
                        <p>Le tableau de bord affiche vos matières sous forme de cartes avec leur taux de progression.</p>
                    </div>
                    <div class="step" data-reveal>
                        <span class="step-num">2</span>
                        <h3>Lire le cours du chapitre</h3>
                        <p>Chaque chapitre regroupe ses cours et son quiz, dans l'ordre recommandé.</p>
                    </div>
                    <div class="step" data-reveal>
                        <span class="step-num">3</span>
                        <h3>Passer le quiz</h3>
                        <p>Une question à la fois, avec une seule bonne réponse. La soumission corrige et enregistre la tentative.</p>
                    </div>
                    <div class="step" data-reveal>
                        <span class="step-num">4</span>
                        <h3>Analyser et recommencer</h3>
                        <p>Score, corrections et explications, puis statistiques par matière pour cibler les révisions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section pb-0">
        <div class="container">
            <div class="p-4 p-md-5 text-white rounded-4" style="background: var(--gradient); box-shadow: var(--shadow-lg);" data-reveal>
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-2">Prêt à réviser plus intelligemment&nbsp;?</h2>
                        <p class="mb-0 text-white-50">
                            Créez votre compte étudiant en quelques secondes, ou connectez-vous à l'espace
                            administrateur pour publier vos premiers cours et quiz.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-lg-column gap-2 justify-content-lg-end">
                        <a href="<?php echo e(url('/register')); ?>" class="btn btn-light fw-semibold">
                            Créer un compte étudiant
                        </a>
                        <a href="<?php echo e(url('/login')); ?>" class="btn btn-outline-light">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <footer class="site-footer mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a class="brand mb-3" href="<?php echo e(url('/')); ?>">
                        <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
                        Ilmify
                    </a>
                    <p class="small mt-2 mb-0" style="max-width: 22rem;">
                        Plateforme de révision pour étudiants : matières, cours, quiz autocorrigés
                        et suivi de progression. Développée avec Laravel, Blade, Bootstrap 5 et MySQL.
                    </p>
                </div>
                <div class="col-6 col-lg-2">
                    <h4>Plateforme</h4>
                    <ul class="list-unstyled d-grid gap-2 mb-0">
                        <li><a href="#features">Fonctionnalités</a></li>
                        <li><a href="#espaces">Espaces</a></li>
                        <li><a href="#parcours">Parcours</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h4>Compte</h4>
                    <ul class="list-unstyled d-grid gap-2 mb-0">
                        <li><a href="<?php echo e(url('/login')); ?>">Connexion</a></li>
                        <li><a href="<?php echo e(url('/register')); ?>">Inscription</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Projet</h4>
                    <ul class="list-unstyled d-grid gap-2 mb-0">
                        <li><span class="small">MDW3 — Développement web</span></li>
                        <li><span class="small">Souhail Saidi &amp; Eya Souey</span></li>
                        <li><span class="small">Laravel 12 · MySQL 8</span></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between gap-2">
                <span>&copy; <span data-current-year>2026</span> Ilmify. Tous droits réservés.</span>
                <span>Conçu et développé dans un cadre pédagogique.</span>
            </div>
        </div>
    </footer>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/pc/ilmify/resources/views/landing.blade.php ENDPATH**/ ?>