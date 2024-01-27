<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCourseOverviewResource;

class GetCourseController extends Controller
{
     /**
     * @OA\Get(
     *  path="/courses/s/{id}",
     *  tags={"courses"},
     *  summary="Get individual course on students dashboard",
     *  description="Get individual course on students dashboard",
     *  security={{"bearer_token": {}}},
     *  @OA\Parameter(
     *      name="id",
     *      description="Course ID (UUID)",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *         type="string",
     *         format="uuid"
     *      ),
     *      @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
     *  ),
     *  @OA\Response(
     *        response="200", 
     *        description="course overview",
     *        @OA\JsonContent(@OA\property(property="data", ref="#/components/schemas/StudentCourseOverviewResource"))
     *  ),
     *  @OA\Response(response="401", description="Unauthenticated"),
     *  @OA\Response(response="404", description="Not Found"),
     * 
     * )
    */
    public function getCourse(Course $course) {

        return new StudentCourseOverviewResource($course);
    }
}
