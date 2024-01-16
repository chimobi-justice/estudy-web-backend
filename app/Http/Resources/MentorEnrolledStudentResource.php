<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MentorStudentDetailsResource;

class MentorEnrolledStudentResource extends JsonResource
{
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
