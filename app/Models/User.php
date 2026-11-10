<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /** Rôles possibles, stockés dans la colonne `role`. */
    public const ROLE_STUDENT = 'student';
    public const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /* ---------------------------------------------------------
     | Aides sur les rôles
     |--------------------------------------------------------- */

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    /**
     * Adresse du tableau de bord correspondant au rôle.
     * Utilisée après la connexion pour envoyer chacun dans son espace.
     */
    public function dashboardUrl(): string
    {
        return $this->isAdmin()
            ? route('admin.dashboard')
            : route('student.dashboard');
    }

    /** Initiales affichées dans les avatars de l'interface. */
    public function initials(): string
    {
        $parts = preg_split('/\s+/', trim($this->name)) ?: [];

        return collect($parts)
            ->take(2)
            ->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->implode('');
    }

    /* ---------------------------------------------------------
     | Relations
     |--------------------------------------------------------- */

    /** Toutes les tentatives de quiz de l'utilisateur. */
    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /** Seulement les tentatives terminées (utile pour les statistiques). */
    public function completedAttempts(): HasMany
    {
        return $this->quizAttempts()->whereNotNull('completed_at');
    }

    /* ---------------------------------------------------------
     | Scopes
     |--------------------------------------------------------- */

    /** Uniquement les comptes étudiants. */
    public function scopeStudents(Builder $query): Builder
    {
        return $query->where('role', self::ROLE_STUDENT);
    }
}
