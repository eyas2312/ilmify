@extends('layouts.student')

@section('title', 'Matières — Ilmify')
@section('eyebrow', 'Espace étudiant')
@section('page-title', 'Matières')

@section('page')

    <section class="page-head">
        <div>
            <h2 class="page-head-title">Choisis une matière</h2>
            <p class="page-head-sub">
                {{ $subjects->count() }} {{ Str::plural('matière', $subjects->count()) }} disponibles,
                {{ $subjects->sum('chapters_count') }} chapitres et
                {{ $subjects->sum('quizzes_count') }} quiz.
            </p>
        </div>
    </section>

    <div class="subject-grid">
        @foreach ($subjects as $subject)
            @include('partials.subject-card', [
                'subject' => $subject,
                'stats' => $perSubject->get($subject->id),
            ])
        @endforeach
    </div>

    <p class="text-muted-2 small mt-4 mb-0">
        <i class="bi bi-info-circle me-1"></i>
        La lecture des cours et le passage des quiz s'ouvrent à la prochaine étape.
    </p>

@endsection
