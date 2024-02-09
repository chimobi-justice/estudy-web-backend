<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetUpdatedCourseResource;

class GetUpdatedCourseController extends Controller
{
    /**
    * @OA\Get(
    *  path="/courses/m/{id}",
    *  tags={"courses"},
    *  summary="Get a courses by id example to update",
    *  description="Get a courses by id example to update",
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
    *        response="200", 
    *        description="Successful operation",
    *        @OA\JsonContent(
    *           @OA\property(
    *             property="data", 
    *             example={
    *               "id": "550e8400-e29b-41d4-a716-446655440000",
    *               "name": "estudy",      
    *               "price": "20.00",
    *               "category": "mobile development",
    *               "description": "estudy decription",
    *               "thumbnail": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg",
    *               "course_preview": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yrfikr4gyecw04sp5ial.jpg",
    *               "video": {
    *                  "https://res.cloudinary.com/estudy/video/upload/v1707148522/ukoxtqbugeyf9vt3v5mt.mp4",
    *                  "https://res.cloudinary.com/estudy/video/upload/v1707148522/ukoxtqbugeyf9vt3v5mt.mp4"
    *               },
    *               "title": {
    *                  "title 1",
    *                  "title 2"
    *               },
    *               "sub_title": {
    *                  "title 1",
    *                  "title 2"
    *               }
    *             }
    *           )
    *        )
    *    )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function getUpdateCourse(Course $course) {

        return new GetUpdatedCourseResource($course);
    }
}
