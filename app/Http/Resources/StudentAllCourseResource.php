<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CourseProfileResourse;
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
            'profile' => new CourseProfileResourse($this->whenLoaded('user')),
        ];
    }
}
