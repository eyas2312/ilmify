<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Matières : le niveau le plus haut de la hiérarchie pédagogique
     * (matière → chapitres → cours / quiz).
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->unique();
            $table->text('description')->nullable();
            // Couleur et icône utilisées par les cartes de matière côté Blade.
            $table->string('color', 20)->default('#5b7d9c');
            $table->string('icon', 40)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
