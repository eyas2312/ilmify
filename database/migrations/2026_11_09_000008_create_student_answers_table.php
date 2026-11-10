<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Détail d'une tentative : la réponse choisie pour chaque question.
     * is_correct est figé au moment de la correction : si l'administrateur
     * modifie plus tard la bonne réponse, l'historique ne change pas.
     */
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_attempt_id')
                ->constrained('quiz_attempts')
                ->cascadeOnDelete();
            $table->foreignId('question_id')
                ->constrained('questions')
                ->cascadeOnDelete();
            $table->foreignId('answer_id')
                ->nullable()
                ->constrained('answers')
                ->nullOnDelete();

            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            // Une seule réponse enregistrée par question et par tentative.
            $table->unique(['quiz_attempt_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
