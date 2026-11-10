<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Comptes de démonstration.
     * Mot de passe commun : "password" (à changer en production).
     */
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Administrateur Ilmify',
                'email' => 'admin@ilmify.test',
                'role' => User::ROLE_ADMIN,
            ],
            [
                'name' => 'Eya Souey',
                'email' => 'eya@ilmify.test',
                'role' => User::ROLE_STUDENT,
            ],
            [
                'name' => 'Souhail Saidi',
                'email' => 'souhail@ilmify.test',
                'role' => User::ROLE_STUDENT,
            ],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'role' => $account['role'],
                    'password' => Hash::make('password'),
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }

        // Quelques étudiants supplémentaires pour peupler les listes de l'admin.
        User::factory()
            ->count(5)
            ->create(['role' => User::ROLE_STUDENT, 'is_active' => true]);
    }
}
