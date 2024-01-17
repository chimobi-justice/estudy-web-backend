<?php

namespace App\Models\Traits\User;

use App\Models\Course;
use App\Models\EnrollCourse;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserTraits {
  public function course(): HasMany {
    return $this->hasMany(Course::class);
  }

  public function courseEnroll(): HasMany {
    return $this->hasMany(EnrollCourse::class);
  }
}