<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCourseOverviewResource;

class GetCourseController extends Controller
{
    public function getCourse(Course $course) {

        return new StudentCourseOverviewResource($course);
    }
}
