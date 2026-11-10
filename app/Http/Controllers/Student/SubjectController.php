<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Support\StudentProgress;
use Illuminate\Contracts\View\View;

class SubjectController extends Controller
{
    /** Liste de toutes les matières actives, avec la progression de l'étudiant. */
    public function index(): View
    {
        $subjects = Subject::query()
            ->active()
            ->withCount(['chapters', 'courses', 'quizzes'])
            ->orderBy('name')
            ->get();

        return view('student.subjects.index', [
            'subjects' => $subjects,
            'perSubject' => StudentProgress::bySubject(auth()->user()),
        ]);
    }

    /**
     * Fiche d'une matière : chapitres, cours et quiz qu'elle contient.
     * Le paramètre `{subject}` est résolu automatiquement par Laravel
     * (route model binding) : 404 si l'identifiant n'existe pas.
     */
    public function show(Subject $subject): View
    {
        abort_unless($subject->is_active, 404);

        $subject->load(['chapters.courses', 'chapters.quizzes']);

        // Meilleure note de l'étudiant pour chaque quiz de la matière.
        $quizIds = $subject->chapters
            ->flatMap(fn ($chapter) => $chapter->quizzes)
            ->pluck('id');

        $bestByQuiz = auth()->user()->completedAttempts()
            ->whereIn('quiz_id', $quizIds)
            ->selectRaw('quiz_id, MAX(score) as best_score, COUNT(*) as attempt_count')
            ->groupBy('quiz_id')
            ->get()
            ->keyBy('quiz_id');

        return view('student.subjects.show', [
            'subject' => $subject,
            'bestByQuiz' => $bestByQuiz,
            'stats' => StudentProgress::bySubject(auth()->user())->get($subject->id),
        ]);
    }
}
