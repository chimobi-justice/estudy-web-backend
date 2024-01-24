<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollCourseController extends Controller
{
     /**
     * @OA\Post(
     *  path="/courses/s/user/{id}/enroll",
     *  tags={"courses"},
     *  summary="Mentee enroll on a course",
     *  description="Mentee enroll on a course",
     *  security={{"bearer_token": {}}},
     *  @OA\Parameter(
     *      name="id",
     *      description="Course ID",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *         type="string",
     *      ),
     *      @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
     *  ),
     *  @OA\Response(
     *        response="200", 
     *        description="course enroll successfully"
     *  ),
     *  @OA\Response(response="401", description="Unauthenticated"),
     *  @OA\Response(response="404", description="Not Found"),
     * 
     * )
    */
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
