<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cours : le contenu pédagogique d'un chapitre.
     * longText car un cours peut être long (HTML simple autorisé).
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')
                ->constrained('chapters')
                ->cascadeOnDelete();

            $table->string('title', 160);
            $table->longText('content');
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['chapter_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
