<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question_text',
        'explanation',
        'points',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'integer',
        ];
    }

    /* ---------------------------------------------------------
     | Relations
     |--------------------------------------------------------- */

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class)->orderBy('position');
    }

    /** La (seule) bonne réponse de la question. */
    public function correctAnswer(): HasOne
    {
        return $this->hasOne(Answer::class)->where('is_correct', true);
    }
}
