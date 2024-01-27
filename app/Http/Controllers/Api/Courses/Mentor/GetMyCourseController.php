<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetMyCourseResource;

class GetMyCourseController extends Controller
{
    /**
    * @OA\Get(
    *  path="/courses/m/all",
    *  tags={"courses"},
    *  summary="Get all courses created by a mentor",
    *  description="Get all courses created by a mentor",
    *  security={{"bearer_token": {}}},
    *  @OA\Response(
    *        response="200", 
    *        description="Successful operation",
    * 
    *     @OA\JsonContent(
    *       @OA\Property(
    *           property="data", 
    *               @OA\Property(property="id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000"),
    *               @OA\Property(property="name", type="string", example="estudy"),
    *               @OA\Property(property="price", type="string", format="currency", example="20.00"),
    *               @OA\Property(property="video", type="numner", example="2"),
    *               @OA\Property(property="created_at", ref="#/components/schemas/DateTimeResource"),
    *      ),
    *    )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function getMyCourse() {
        $courses = Course::where('user_id', auth()->user()->id)->latest()->get();

        return GetMyCourseResource::collection($courses);
    }
}
