<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnEnrollCourseController extends Controller
{
    public function unEnrollCoures(Request $request, Course $course) {
        $request->user()->courseEnroll()->where('course_id', $course->id)->delete();

        return response([
            'message' => 'Course  unenrolled successfully'
        ]);
    }
}
