<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollCourseController extends Controller
{
    public function enrollCourse(Request $request, Course $course) {
        if ($course->enrollByUser($request->user())) {
            return response(null, 409);
        }

        $course->courseEnroll()->create([
            'user_id' => $request->user()->id,
            'course_id' => $course->id,
            'owner_id' => $course->user_id
        ]);

        return response([
            'message' => 'course enroll successfully'
        ]);
    }
}
