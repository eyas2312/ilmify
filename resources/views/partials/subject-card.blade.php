{{--
    Carte d'une matière, réutilisée par le tableau de bord et la liste des matières.
    Attend :
      - $subject : matière chargée avec withCount('chapters', 'courses', 'quizzes')
      - $stats   : objet { average_score, best_score, attempt_count } ou null
--}}
@php
    $color = $subject->color ?: '#5b7d9c';
    $average = $stats ? (int) $stats->average_score : 0;
    $attemptCount = $stats ? (int) $stats->attempt_count : 0;
    $best = $stats ? (int) $stats->best_score : null;
@endphp

<a class="subject-card" href="{{ route('student.subjects.show', $subject) }}"
   style="--subject: {{ $color }}">
    <div class="subject-card-top">
        <span class="subject-icon"><i class="bi {{ $subject->icon ?: 'bi-journal' }}"></i></span>
        <span class="subject-average">{{ $average }}<small>%</small></span>
    </div>

    <h3 class="subject-title">{{ $subject->name }}</h3>
    <p class="subject-desc">{{ Str::limit($subject->description, 92) }}</p>

    <div class="subject-progress">
        <div class="progress-thin">
            <span style="width: {{ $average }}%; background: {{ $color }}"></span>
        </div>
        <div class="subject-progress-label">
            <span>Moyenne</span>
            <span>{{ $attemptCount }} {{ Str::plural('tentative', $attemptCount) }}</span>
        </div>
    </div>

    <div class="subject-card-foot">
        <span><i class="bi bi-collection me-1"></i>{{ $subject->chapters_count }} chapitres</span>
        <span><i class="bi bi-journal-text me-1"></i>{{ $subject->courses_count }} cours</span>
        <span><i class="bi bi-patch-question me-1"></i>{{ $subject->quizzes_count }} quiz</span>
        <i class="bi bi-arrow-right subject-arrow ms-auto"></i>
    </div>

    @if ($best !== null)
        <span class="subject-best">
            <i class="bi bi-star"></i> Meilleure note : {{ $best }} %
        </span>
    @endif
</a>
