@extends('layouts.student')

@php
    $color = $subject->color ?: '#5b7d9c';
@endphp

@section('title', $subject->name . ' — Ilmify')
@section('eyebrow', 'Espace étudiant')
@section('page-title', $subject->name)

@section('page')

    <nav class="crumb" aria-label="Fil d'Ariane">
        <a href="{{ route('student.subjects.index') }}">Matières</a>
        <i class="bi bi-chevron-right"></i>
        <span>{{ $subject->name }}</span>
    </nav>

    {{-- ---------- En-tête de la matière ---------- --}}
    <section class="subject-hero" style="--subject: {{ $color }}">
        <span class="subject-icon subject-icon--lg"><i class="bi {{ $subject->icon ?: 'bi-journal' }}"></i></span>

        <div class="subject-hero-body">
            <h2 class="page-head-title">{{ $subject->name }}</h2>
            <p class="subject-hero-desc">{{ $subject->description }}</p>

            <div class="subject-hero-stats">
                <span><b>{{ $subject->chapters->count() }}</b> chapitres</span>
                <span><b>{{ $subject->chapters->sum(fn ($chapter) => $chapter->courses->count()) }}</b> cours</span>
                <span><b>{{ $subject->chapters->sum(fn ($chapter) => $chapter->quizzes->count()) }}</b> quiz</span>
                <span>
                    <b>{{ $stats ? (int) $stats->average_score : 0 }} %</b> de moyenne
                </span>
            </div>
        </div>

        <a class="btn btn-soft btn-sm align-self-start" href="{{ route('student.dashboard') }}">
            <i class="bi bi-arrow-left me-1"></i>Tableau de bord
        </a>
    </section>

    {{-- ---------- Chapitres ---------- --}}
    <section class="mt-4">
        <div class="section-row">
            <div>
                <h3 class="panel-title">Chapitres</h3>
                <p class="panel-sub">Chaque chapitre contient un cours et un quiz de validation.</p>
            </div>
        </div>

        <div class="chapter-list">
            @forelse ($subject->chapters as $chapter)
                <article class="chapter-item">
                    <span class="chapter-num">{{ $chapter->position }}</span>

                    <div class="chapter-body">
                        <h4 class="chapter-title">{{ $chapter->title }}</h4>
                        <p class="chapter-desc">{{ $chapter->description }}</p>

                        @foreach ($chapter->courses as $course)
                            <div class="content-row">
                                <i class="bi bi-file-earmark-text"></i>
                                <span class="content-row-title">{{ $course->title }}</span>
                                <span class="pill pill--plain">Cours</span>
                            </div>
                        @endforeach

                        @foreach ($chapter->quizzes as $quiz)
                            @php
                                $result = $bestByQuiz->get($quiz->id);
                                $best = $result ? (int) $result->best_score : null;
                            @endphp

                            <div class="content-row">
                                <i class="bi bi-patch-question"></i>
                                <span class="content-row-title">{{ $quiz->title }}</span>

                                @if ($best === null)
                                    <span class="pill pill--plain">Non tenté</span>
                                @elseif ($best >= $quiz->passing_score)
                                    <span class="pill pill--pass"><i class="bi bi-check2"></i>{{ $best }} %</span>
                                @else
                                    <span class="pill pill--fail"><i class="bi bi-arrow-repeat"></i>{{ $best }} %</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </article>
            @empty
                <div class="empty-note">
                    <i class="bi bi-collection"></i>
                    <p>Cette matière n'a pas encore de chapitre.</p>
                </div>
            @endforelse
        </div>
    </section>

    <p class="text-muted-2 small mt-4 mb-0">
        <i class="bi bi-info-circle me-1"></i>
        L'ouverture des cours et le passage des quiz arrivent à la prochaine étape.
    </p>

@endsection
