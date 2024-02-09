<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseProfileOverviewResource;

/**
 * @OA\Schema(
 *  title="StudentCourseOverviewResource",
 *  description="course overview resource",
 *  @OA\Xml(
 *   name="StudentCourseOverviewResource"
 *  )
 * )
*/
class StudentCourseOverviewResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="id",
     *   type="string",
     *   format="uuid",
     *   description="Course ID",
     *   example="550e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   description="Course name",
     *   example="Intro Course"
     * )
     * @OA\Property(
     *   property="description",
     *   type="string",
     *   description="Course description",
     *   example="example of course description"
     * )
     * @OA\Property(
     *   property="title",
     *   type="array",
     *   description="Course title",
     *   @OA\Items(type="string", example="Introduction")
     * )
     * @OA\Property(
     *   property="video",
     *   type="array",
     *   description="Number of videos in the course",
     *    @OA\Items(type="string", example="https://res.cloudinary.com/driggenlearn/video/upload/v1706030614/ayroiowquwwrgdogsznn.mp4")
     * )
     * @OA\Property(
     *   property="profile",
     *   ref="#/components/schemas/CourseProfileOverviewResource"
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
            'name' => $this->name,
            'description' => $this->description,
            'title' => $this->title,
            'video' => $this->video,
            'isEnrolled' => $this->whenLoaded('courseEnroll', function () {
                return $this->courseEnroll->contains('user_id', auth()->id());
            }),
            'profile' => new CourseProfileOverviewResource($this->whenLoaded('user')),
        ];
    }
}
