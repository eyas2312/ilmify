<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'icon',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /* ---------------------------------------------------------
     | Relations
     |--------------------------------------------------------- */

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('position');
    }

    /**
     * Tous les cours de la matière, en traversant les chapitres.
     * SQL : courses ⋈ chapters ⋈ subjects (via chapters.subject_id).
     */
    public function courses(): HasManyThrough
    {
        return $this->hasManyThrough(Course::class, Chapter::class);
    }

    /** Tous les quiz de la matière, en traversant les chapitres. */
    public function quizzes(): HasManyThrough
    {
        return $this->hasManyThrough(Quiz::class, Chapter::class);
    }

    /* ---------------------------------------------------------
     | Scopes
     |--------------------------------------------------------- */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
