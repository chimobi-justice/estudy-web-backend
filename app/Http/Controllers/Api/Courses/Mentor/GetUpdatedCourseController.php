<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetUpdatedCourseResource;

class GetUpdatedCourseController extends Controller
{
    public function getUpdateCourse(Course $course) {

        return new GetUpdatedCourseResource($course);
    }
}
