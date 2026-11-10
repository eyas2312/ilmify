<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Quiz : rattaché à un chapitre.
     * is_published évitera d'afficher un quiz en cours de rédaction.
     * passing_score = seuil de réussite en pourcentage.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')
                ->constrained('chapters')
                ->cascadeOnDelete();

            $table->string('title', 160);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('passing_score')->default(50);
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index(['chapter_id', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
