<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Chapitres : subdivision d'une matière.
     * La suppression d'une matière supprime ses chapitres (cascade).
     */
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->string('title', 160);
            $table->text('description')->nullable();
            // Ordre d'affichage défini par l'administrateur.
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['subject_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
