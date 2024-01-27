<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MentorStudentDetailsResource;

/**
 * @OA\Schema(
 *  title="MentorEnrolledStudentResource",
 *  description="get all students enrolled on mentor courses",
 *  @OA\Xml(
 *   name="MentorEnrolledStudentResource"
 *  )
 * )
*/
class MentorEnrolledStudentResource extends JsonResource
{
    /**
     * @OA\Property(
     *  property="id",
     *  type="string",
     *  format="uuid",
     *  description="id",
     *  example="550e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *  property="course_id",
     *  type="string",
     *  format="uuid",
     *  description="course id",
     *  example="550e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *  property="owner_id",
     *  type="string",
     *  format="uuid",
     *  description="owner id",
     *  example="550e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *  property="course_details",
     *  type="object",
     *  description="get course details name",
     *  example={"course_name":"course name"}
     * )
     * @OA\Property(
     *  description="get date when user enroll",
     *  property="enrolled_user_details", ref="#/components/schemas/MentorStudentDetailsResource"
     * )
     * @OA\Property(
     *  description="get date when user enroll",
     *  property="created_at", ref="#/components/schemas/DateTimeResource"
     * )
     * @OA\Property(
     *  property="pagination",
     *  type="object",
     *  description="get the paginated details",
     *  example={
     *   "current_page": 1,
     *   "last_page": 2,
     *   "total": 8, 
     *  }
     * )
    */
    private $data;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'owner_id' => $this->owner_id,
            'course_details' => $this->getCourseDetails($this->course_id),
            'enrolled_user_details' => MentorStudentDetailsResource::make($this->whenLoaded('user')),
            'enrolled_at' => DateTimeResource::make($this->created_at),
        ];
    }

    private function getCourseDetails($courseId): ?array
    {
        $course = Course::find($courseId);

        if ($course) {
            return [
                'course_name' => $course->name,
            ];
        }

        return null;
    }
}
