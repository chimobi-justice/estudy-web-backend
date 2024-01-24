<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnEnrollCourseController extends Controller
{
      /**
     * @OA\Post(
     *  path="/courses/s/user/{id}/unenroll",
     *  tags={"courses"},
     *  summary="Mentee unenroll from a course",
     *  description="Mentee unenroll from a course",
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
     *        description="course unenroll successfully"
     *  ),
     *  @OA\Response(response="401", description="Unauthenticated"),
     *  @OA\Response(response="404", description="Not Found"),
     * 
     * )
    */
    public function unEnrollCoures(Request $request, Course $course) {
        $request->user()->courseEnroll()->where('course_id', $course->id)->delete();

        return response([
            'message' => 'Course  unenrolled successfully'
        ]);
    }
}
