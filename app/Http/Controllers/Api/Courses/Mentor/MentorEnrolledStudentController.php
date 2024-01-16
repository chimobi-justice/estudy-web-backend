<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\EnrollCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MentorEnrolledStudentResource;

class MentorEnrolledStudentController extends Controller
{
    public function mentorEnrolledStudents(Request $request) {

        $ownerOfCourseId = $request->user()->id;

        $enrolledCourses = EnrollCourse::with('user')->where('owner_id', $ownerOfCourseId)->latest()->paginate(3);

        return MentorEnrolledStudentResource::collection($enrolledCourses)->additional([
            'pagination' => [
                'current_page' => $enrolledCourses->currentPage(),
                'last_page' => $enrolledCourses->lastPage(),
                'total' => $enrolledCourses->total()
            ]
        ]);
    }
}