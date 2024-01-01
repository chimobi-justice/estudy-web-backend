<?php

namespace App\Models\Traits\Course;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CourseTraits {
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }
}