<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Quiz extends Model
{
    protected $fillable = [
        'chapter_id',
        'title',
        'description',
        'passing_score',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'passing_score' => 'integer',
        ];
    }

    /* ---------------------------------------------------------
     | Relations
     |--------------------------------------------------------- */

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('position');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /** Toutes les propositions du quiz (utile pour l'édition admin). */
    public function answers(): HasManyThrough
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }

    /* ---------------------------------------------------------
     | Aides
     |--------------------------------------------------------- */

    public function totalPoints(): int
    {
        return (int) $this->questions->sum('points');
    }

    /* ---------------------------------------------------------
     | Scopes
     |--------------------------------------------------------- */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
