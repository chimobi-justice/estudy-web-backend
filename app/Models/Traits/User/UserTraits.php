<?php

namespace App\Models\Traits\User;

use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserTraits {
  public function course(): HasMany {
    return $this->hasMany(Course::class);
  }
}