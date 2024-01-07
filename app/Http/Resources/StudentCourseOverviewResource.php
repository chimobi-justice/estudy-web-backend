<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseProfileOverviewResource;

class StudentCourseOverviewResource extends JsonResource
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
            'video' => $this->video,
            'profile' => new CourseProfileOverviewResource($this->whenLoaded('user')),
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
