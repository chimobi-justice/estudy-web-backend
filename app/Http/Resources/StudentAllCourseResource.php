<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\CourseEnrollResource;
use App\Http\Resources\CourseProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentAllCourseResource extends JsonResource
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
            'thumbnail' => $this->thumbnail,
            'price' => $this->price,
            'profile' => new CourseProfileResource($this->whenLoaded('user')),
            'isEnrolled' => $this->whenLoaded('courseEnroll', function () {
                return $this->courseEnroll->contains('user_id', auth()->id());
            }),
            'courseEnroll' => CourseEnrollResource::collection($this->whenLoaded('courseEnroll')),
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
