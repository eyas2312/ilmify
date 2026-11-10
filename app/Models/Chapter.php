<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    protected $fillable = [
        'subject_id',
        'title',
        'description',
        'position',
    ];

    /* ---------------------------------------------------------
     | Relations
     |--------------------------------------------------------- */

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)->orderBy('position');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class)->orderBy('id');
    }

    /* ---------------------------------------------------------
     | Scopes
     |--------------------------------------------------------- */

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position')->orderBy('id');
    }
}
