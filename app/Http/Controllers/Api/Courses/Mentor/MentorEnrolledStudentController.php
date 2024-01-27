<?php

namespace App\Http\Controllers\Api\Courses\Mentor;

use App\Models\EnrollCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MentorEnrolledStudentResource;

class MentorEnrolledStudentController extends Controller
{
    /**
     * @OA\Get(
     *  path="/courses/m/enrolled-students",
     *  tags={"courses"},
     *  summary="Get all students enrolled on a mentor course",
     *  description="Get all students enrolled on a mentor course",
     *  security={{"bearer_token": {}}},
     *  @OA\Response(
     *        response="200", 
     *        description="course overview",
     *        @OA\JsonContent(
     *          @OA\property(
     *            property="data", 
     *            type="array", 
     *            @OA\Items(ref="#/components/schemas/MentorEnrolledStudentResource")
     *          )
     *      )
     *  ),
     *  @OA\Response(response="401", description="Unauthenticated"),
     *  @OA\Response(response="404", description="Not Found"),
     * )
    */
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