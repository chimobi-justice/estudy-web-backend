<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteCourseController extends Controller
{
    /**
    * @OA\Delete(
    *  path="/courses/m/{id}",
    *  tags={"courses"},
    *  summary="Mentor delete a created course",
    *  description="Mentor delete a created course",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Course ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string",
    *         format="uuid"
    *      ),
    *      @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
    *  ),
    *  @OA\Response(
    *        response="204", 
    *        description="Successful operation"
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="403", description="Forbidden"),
    * )
    */
    public function deleteCourse(Request $request, Course $course) {

        $this->authorize('delete', $course);
        
        $course->delete();

        return response(null, 204);
    }
}
