<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCoursePaidOverviewResource;

class GetPaidCourseController extends Controller
{
    public function getPaidCourse(Course $course) {

        return new StudentCoursePaidOverviewResource($course);
    }
}
