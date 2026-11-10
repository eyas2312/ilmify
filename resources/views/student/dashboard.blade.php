@extends('layouts.student')

@section('title', 'Tableau de bord — Ilmify')
@section('eyebrow', 'Espace étudiant')
@section('page-title', 'Tableau de bord')

@section('page')

    <section class="page-head">
        <div>
            <h2 class="page-head-title">Bonjour {{ auth()->user()->name }} 👋</h2>
            <p class="page-head-sub">Voilà où tu en es dans tes révisions aujourd'hui.</p>
        </div>
        <a class="btn btn-brand" href="{{ route('student.subjects.index') }}">
            <i class="bi bi-journal-bookmark me-1"></i>Explorer les matières
        </a>
    </section>

    {{-- ---------- Indicateurs ---------- --}}
    <div class="stat-grid">
        <div class="stat-card">
            <span class="stat-icon"><i class="bi bi-graph-up-arrow"></i></span>
            <small>Moyenne générale</small>
            <b>{{ $average !== null ? $average . ' %' : '—' }}</b>
            <span class="stat-foot">
                {{ $average === null ? 'Aucun quiz terminé' : 'Sur toutes les tentatives' }}
            </span>
        </div>

        <div class="stat-card">
            <span class="stat-icon"><i class="bi bi-check2-square"></i></span>
            <small>Quiz terminés</small>
            <b>{{ $attempts->count() }}</b>
            <span class="stat-foot">Tentatives corrigées</span>
        </div>

        <div class="stat-card">
            <span class="stat-icon"><i class="bi bi-trophy"></i></span>
            <small>Quiz réussis</small>
            <b>{{ $passed }}</b>
            <span class="stat-foot">Score supérieur au seuil</span>
        </div>

        <div class="stat-card">
            <span class="stat-icon"><i class="bi bi-collection"></i></span>
            <small>Matières</small>
            <b>{{ $subjects->count() }}</b>
            <span class="stat-foot">{{ $subjects->sum('chapters_count') }} chapitres au total</span>
        </div>
    </div>

    {{-- ---------- Graphique + dernières tentatives ---------- --}}
    <div class="row g-4 mt-1">
        <div class="col-lg-7">
            <div class="panel h-100">
                <div class="panel-head">
                    <div>
                        <h3 class="panel-title">Moyenne par matière</h3>
                        <p class="panel-sub">Calculée sur tes tentatives terminées.</p>
                    </div>
                    <span class="pill pill--plain">Sur 100</span>
                </div>

                @if ($attempts->isNotEmpty())
                    <div class="chart-wrap">
                        <canvas id="subjectChart" aria-label="Moyenne par matière" role="img"></canvas>
                    </div>
                @else
                    <div class="empty-note">
                        <i class="bi bi-bar-chart-line"></i>
                        <p>Ton graphique apparaîtra dès ton premier quiz terminé.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel h-100">
                <div class="panel-head">
                    <h3 class="panel-title">Dernières tentatives</h3>
                </div>

                @forelse ($attempts->take(4) as $attempt)
                    <div class="attempt-row">
                        <span class="attempt-score {{ $attempt->hasPassed() ? 'is-pass' : 'is-fail' }}">
                            {{ $attempt->score }} %
                        </span>
                        <div class="attempt-body">
                            <div class="attempt-title">{{ $attempt->quiz->title }}</div>
                            <div class="attempt-meta">
                                {{ $attempt->quiz->chapter->subject->name }}
                                <span>·</span>
                                {{ $attempt->completed_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-note">
                        <i class="bi bi-clock-history"></i>
                        <p>Aucune tentative pour l'instant. Choisis une matière pour commencer.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ---------- Matières ---------- --}}
    <section class="mt-4" id="matieres">
        <div class="section-row">
            <div>
                <h3 class="panel-title">Tes matières</h3>
                <p class="panel-sub">Clique sur une matière pour voir ses chapitres et ses quiz.</p>
            </div>
            <a class="btn btn-soft btn-sm" href="{{ route('student.subjects.index') }}">Tout voir</a>
        </div>

        <div class="subject-grid">
            @foreach ($subjects as $subject)
                @include('partials.subject-card', [
                    'subject' => $subject,
                    'stats' => $perSubject->get($subject->id),
                ])
            @endforeach
        </div>
    </section>

@endsection

@push('scripts')
<script>
    /*
     * Graphique Chart.js : une barre par matière.
     * Les données sont préparées côté serveur (contrôleur) et injectées
     * ici en JSON — aucun appel AJAX supplémentaire n'est nécessaire.
     */
    (function () {
        const canvas = document.getElementById('subjectChart');
        if (!canvas || typeof Chart === 'undefined') {
            return;
        }

        const chart = @json($chart);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: chart.labels,
                datasets: [{
                    label: 'Moyenne',
                    data: chart.values,
                    backgroundColor: '#8aa7bf',
                    hoverBackgroundColor: '#5b7d9c',
                    borderRadius: 6,
                    maxBarThickness: 56
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (item) => 'Moyenne : ' + item.parsed.y + ' %'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: { callback: (value) => value + ' %', color: '#6f7f8d' },
                        grid: { color: '#eef2f6' }
                    },
                    x: {
                        ticks: { color: '#6f7f8d' },
                        grid: { display: false }
                    }
                }
            }
        });
    })();
</script>
@endpush
