<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteCourseController extends Controller
{
    public function deleteCourse(Request $request, Course $course) {

        $this->authorize('delete', $course);
        
        $course->delete();

        return response([
            'message' => 'Course deleted successfully'
        ]);
    }
}
