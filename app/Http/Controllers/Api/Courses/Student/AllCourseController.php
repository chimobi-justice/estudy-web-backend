<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAllCourseResource;

class AllCourseController extends Controller
{
    public function allCourse() {
        $courses = Course::with(['user'])->get();
        
        return StudentAllCourseResource::collection($courses);
    }
}
