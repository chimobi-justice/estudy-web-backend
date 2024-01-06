<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAllCourseResource;

class AllCourseController extends Controller
{
    public function allCourse(Request $request) {
        $courses = Course::latest()->get();

        return StudentAllCourseResource::collection($courses);
    }
}
