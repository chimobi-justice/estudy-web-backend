<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\Response;

class MentorCoursesPolicy
{
    public function create(User $user): bool
    {
        return $user->role === 'mentor';
    }

    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }
}
