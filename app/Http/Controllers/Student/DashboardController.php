<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use App\Models\Subject;
use App\Support\StudentProgress;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Tableau de bord de l'étudiant : indicateurs, graphique et matières.
     */
    public function __invoke(): View
    {
        $user = auth()->user();

        // Toutes les tentatives terminées, de la plus récente à la plus ancienne.
        // On charge quiz → chapitre → matière pour afficher les noms sans requête
        // supplémentaire (eager loading).
        $attempts = $user->completedAttempts()
            ->with('quiz.chapter.subject')
            ->latest('completed_at')
            ->get();

        // Statistiques agrégées par matière (une seule requête SQL).
        $perSubject = StudentProgress::bySubject($user);

        // Matières actives avec le nombre de chapitres, cours et quiz de chacune.
        $subjects = Subject::query()
            ->active()
            ->withCount(['chapters', 'courses', 'quizzes'])
            ->orderBy('name')
            ->get();

        $passed = $attempts->filter(fn (QuizAttempt $attempt) => $attempt->hasPassed())->count();

        return view('student.dashboard', [
            'subjects' => $subjects,
            'perSubject' => $perSubject,
            'attempts' => $attempts,
            'average' => $attempts->isEmpty() ? null : (int) round($attempts->avg('score')),
            'passed' => $passed,
            // Données du graphique Chart.js : une barre par matière.
            'chart' => [
                'labels' => $subjects->pluck('name'),
                'values' => $subjects->map(
                    fn (Subject $subject) => (int) ($perSubject->get($subject->id)->average_score ?? 0)
                ),
            ],
        ]);
    }
}
