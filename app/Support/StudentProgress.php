<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Calcule les statistiques d'un étudiant à partir de ses tentatives.
 *
 * Ces chiffres sont demandés par plusieurs pages (tableau de bord, liste des
 * matières). Les regrouper ici évite de dupliquer la même requête SQL.
 */
class StudentProgress
{
    /**
     * Moyenne, meilleure note et nombre de tentatives, matière par matière.
     *
     * On part des tentatives terminées de l'étudiant, on remonte jusqu'à la
     * matière en joignant quiz_attempts → quizzes → chapters, puis on regroupe
     * sur chapters.subject_id. Une seule requête agrégée remplace donc une
     * boucle PHP sur chaque matière.
     *
     * Retourne une collection indexée par identifiant de matière :
     * ->get($subjectId)->average_score, ->best_score, ->attempt_count.
     */
    public static function bySubject(User $user): Collection
    {
        return DB::table('quiz_attempts')
            ->join('quizzes', 'quizzes.id', '=', 'quiz_attempts.quiz_id')
            ->join('chapters', 'chapters.id', '=', 'quizzes.chapter_id')
            ->where('quiz_attempts.user_id', $user->id)
            ->whereNotNull('quiz_attempts.completed_at')
            ->groupBy('chapters.subject_id')
            ->selectRaw('chapters.subject_id as subject_id')
            ->selectRaw('COUNT(*) as attempt_count')
            ->selectRaw('ROUND(AVG(quiz_attempts.score)) as average_score')
            ->selectRaw('MAX(quiz_attempts.score) as best_score')
            ->get()
            ->keyBy('subject_id');
    }
}
