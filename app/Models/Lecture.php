<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecture extends Model
{
    protected $fillable = ['course_id', 'lecture_title', 'lecture_description', 'lecture_files'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
