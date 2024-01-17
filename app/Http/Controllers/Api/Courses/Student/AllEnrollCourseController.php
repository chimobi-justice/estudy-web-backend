<?php

namespace App\Http\Controllers\Api\Courses\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentEnrollResource;

class AllEnrollCourseController extends Controller
{
    public function allCourseEnrolled(Request $request) {
        $courseEnrollByUser = DB::table('courses')
                    ->join('enroll_courses', 'courses.id', '=', 'enroll_courses.course_id')
                    ->where('enroll_courses.user_id', '=', $request->user()->id)->get();

        return StudentEnrollResource::collection($courseEnrollByUser);
    }
}
