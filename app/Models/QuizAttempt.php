<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'correct_answers',
        'total_questions',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'correct_answers' => 'integer',
            'total_questions' => 'integer',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    /* ---------------------------------------------------------
     | Relations
     |--------------------------------------------------------- */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Détail des réponses données.
     * La clé étrangère est quiz_attempt_id : on la précise pour rester explicite.
     */
    public function studentAnswers(): HasMany
    {
        return $this->hasMany(StudentAnswer::class, 'quiz_attempt_id');
    }

    /* ---------------------------------------------------------
     | Aides
     |--------------------------------------------------------- */

    public function hasPassed(): bool
    {
        return $this->score >= ($this->quiz->passing_score ?? 50);
    }

    /** Durée en minutes, arrondie, pour l'affichage de l'historique. */
    public function durationInMinutes(): ?int
    {
        if (! $this->started_at || ! $this->completed_at) {
            return null;
        }

        return (int) round($this->started_at->diffInSeconds($this->completed_at) / 60);
    }

    /* ---------------------------------------------------------
     | Scopes
     |--------------------------------------------------------- */

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->whereNotNull('completed_at');
    }

    public function scopeForUser(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
    }
}
