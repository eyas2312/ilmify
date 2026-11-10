<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttemptSeeder extends Seeder
{
    /**
     * Quelques tentatives déjà corrigées, pour que les tableaux de bord,
     * l'historique et les graphiques aient des données dès le départ.
     */
    public function run(): void
    {
        $quizzes = Quiz::with('questions.answers')
            ->published()
            ->orderBy('id')
            ->get()
            ->filter(fn (Quiz $quiz) => $quiz->questions->isNotEmpty())
            ->values();

        if ($quizzes->isEmpty()) {
            return;
        }

        $eya = User::where('email', 'eya@ilmify.test')->first();
        $souhail = User::where('email', 'souhail@ilmify.test')->first();

        // [étudiant, nombre de quiz à traiter, série de résultats attendus]
        $plans = [
            [$eya, 4, [true, true, false, true]],
            [$souhail, 3, [false, true, true]],
        ];

        foreach ($plans as [$user, $quizCount, $outcomes]) {
            if (! $user) {
                continue;
            }

            foreach ($quizzes->take($quizCount) as $index => $quiz) {
                $this->seedAttempt($user, $quiz, $outcomes[$index % count($outcomes)], $index);
            }
        }
    }

    /**
     * Crée une tentative cohérente : une réponse par question,
     * un score calculé, et un is_correct figé sur chaque ligne.
     */
    private function seedAttempt(User $user, Quiz $quiz, bool $shouldPass, int $index): void
    {
        if (QuizAttempt::where('user_id', $user->id)->where('quiz_id', $quiz->id)->exists()) {
            return;
        }

        $startedAt = now()->subDays(10 - $index)->setTime(18, 30);
        $completedAt = $startedAt->copy()->addMinutes(7 + $index);

        $total = $quiz->questions->count();
        $correct = $shouldPass ? max(1, (int) round($total * 0.7)) : (int) floor($total / 3);

        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => (int) round($correct / $total * 100),
            'correct_answers' => $correct,
            'total_questions' => $total,
            'started_at' => $startedAt,
            'completed_at' => $completedAt,
        ]);

        foreach ($quiz->questions->values() as $position => $question) {
            $isCorrect = $position < $correct;

            $answer = $isCorrect
                ? $question->answers->firstWhere('is_correct', true)
                : $question->answers->firstWhere('is_correct', false);

            $attempt->studentAnswers()->create([
                'question_id' => $question->id,
                'answer_id' => $answer?->id,
                'is_correct' => $isCorrect,
                'created_at' => $completedAt,
                'updated_at' => $completedAt,
            ]);
        }
    }
}
