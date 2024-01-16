<?php

namespace App\Models\Traits\Course;

use App\Models\User;
use App\Models\EnrollCourse;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CourseTraits {
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  public function courseEnroll(): HasMany {
    return $this->hasMany(EnrollCourse::class);
  }

  public function enrollByUser(User $user) {
    return $this->courseEnroll->contains('user_id', $user->id);
  }
}