<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCoursePaidOverviewResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'thumbnail' => $this->thumbnail,
            'video' => $this->video,
            'course_preview' => $this->course_preview,
            'isEnrolled' => $this->whenLoaded('courseEnroll', function () {
                return $this->courseEnroll->contains('user_id', auth()->id());
            }),
            'profile' => new CourseProfileOverviewResource($this->whenLoaded('user')),
        ];;
    }
}
