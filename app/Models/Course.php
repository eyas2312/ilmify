<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'chapter_id',
        'title',
        'content',
        'position',
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /** Raccourci pour remonter jusqu'à la matière depuis un cours. */
    public function subject(): ?Subject
    {
        return $this->chapter?->subject;
    }
}
