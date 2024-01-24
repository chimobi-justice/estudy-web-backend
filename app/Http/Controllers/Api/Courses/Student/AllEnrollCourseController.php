<?php

namespace App\Http\Controllers\Api\Courses\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentEnrollResource;

class AllEnrollCourseController extends Controller
{
    /**
    * @OA\Get(
    *  path="/courses/s/user/enroll-courses",
    *  tags={"courses"},
    *  summary="Get all courses enrolled for a particular mentee",
    *  description="Get all courses enrolled for a particular mentee",
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
    *               @OA\Property(property="course_id", type="string", format="uuid", example="450e8400-e29b-41d4-a716-446655440000"),
    *               @OA\Property(property="name", type="string", example="estudy"),
    *               @OA\Property(property="thumbnail", type="string", example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg"),
    *               @OA\Property(property="price", type="string", format="currency", example="20.00")
    *           ),
    *      ),
    *    )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function allCourseEnrolled(Request $request) {
        $courseEnrollByUser = DB::table('courses')
                    ->join('enroll_courses', 'courses.id', '=', 'enroll_courses.course_id')
                    ->where('enroll_courses.user_id', '=', $request->user()->id)->get();

        return StudentEnrollResource::collection($courseEnrollByUser);
    }
}