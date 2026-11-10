<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * L'ordre compte : les utilisateurs, puis le contenu pédagogique
     * (matières → chapitres → cours/quiz), puis les tentatives qui
     * référencent à la fois les utilisateurs et les quiz.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SubjectSeeder::class,
            AttemptSeeder::class,
        ]);
    }
}
