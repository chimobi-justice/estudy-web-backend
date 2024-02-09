<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use App\Models\EnrollCourse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MentorStudentDetailsResource;

/**
 * @OA\Schema(
 *  title="CourseProfileOverviewResource",
 *  description="Course overview",
 *  @OA\Xml(
 *   name="CourseProfileOverviewResource"
 *  )
 * )
*/
class CourseProfileOverviewResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="fullname",
     *   type="string",
     *   description="full name",
     *   example="Gift Owens"
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
        $course = $request->route('course');

        return [
            'id' => $this->id, 
            'fullname' => $this->fullname,
            'bio' => $this->when($request->is('api/courses/s/paid-overview/' . $course->slug), function() {
                return $this->getBio();
            }),
        ];
    }

    private function getBio() {
        $coursesCount = $this->course->count();

        // $studentCount = $this->courseEnroll()->count();

        return [
           'avatar' => $this->avatar,
           'description' => $this->bio,
           'occupation' => $this->occupation,
        //    'student_count' => $studentCount . ' ' . Str::plural('student', $studentCount),
           'courses_count' => $coursesCount . ' ' .  Str::plural('course', $coursesCount), 
        ];
    }
}
