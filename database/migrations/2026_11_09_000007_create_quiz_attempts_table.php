<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Une tentative = un étudiant qui soumet un quiz.
     * On conserve le score ET les compteurs, pour pouvoir afficher
     * l'historique sans recalculer, tout en gardant student_answers
     * comme détail vérifiable.
     */
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('quiz_id')
                ->constrained('quizzes')
                ->cascadeOnDelete();

            // Score en pourcentage (0-100).
            $table->unsignedTinyInteger('score')->default(0);
            $table->unsignedSmallInteger('correct_answers')->default(0);
            $table->unsignedSmallInteger('total_questions')->default(0);

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Historique d'un étudiant, et résultats d'un quiz côté admin.
            $table->index(['user_id', 'completed_at']);
            $table->index(['quiz_id', 'completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
