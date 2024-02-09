<?php

namespace App\Http\Controllers\Api\Courses\Student;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAllCourseResource;

class AllCourseController extends Controller
{
    /**
    * @OA\Get(
    *  path="/courses/s/all",
    *  tags={"courses"},
    *  summary="Get all courses students not enrolled in",
    *  description="Get all courses for students dashboard",
    *  security={{"bearer_token": {}}},
    *  @OA\Response(
    *        response="200", 
    *        description="Successful operation",
    * 
    *     @OA\JsonContent(
    *       @OA\Property(
    *           property="data", 
    *           type="array",
    *           @OA\Items(
    *               type="object",
    *               @OA\Property(property="id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000"),
    *               @OA\Property(property="name", type="string", example="intro course"),
    *               @OA\Property(property="slug", type="string", example="intro-course"),
    *               @OA\Property(property="thumbnail", type="string", example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg"),
    *               @OA\Property(property="price", type="string", format="currency", example="20.00"),
    *               @OA\Property(property="isEnrolled", type="boolean", example="false"),
    *               @OA\Property(property="profile", ref="#/components/schemas/CourseProfileResource"),
    *               @OA\Property(property="created_at", ref="#/components/schemas/DateTimeResource"),
    *           ),
    *      ),
    *    )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function allCourse(Request $request) {
        $userId = $request->user()->id;

        $courses = Course::whereDoesntHave('courseEnroll', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->latest()->get();

        return StudentAllCourseResource::collection($courses);
    }
}