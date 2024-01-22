<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicCourseResource extends JsonResource
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
            'price' => $this->price,
            'thumbnail' => $this->thumbnail,
            'category' => $this->category,
            'description' => $this->description,
            'video' => collect($this->video)->count(),
            'profile' => new CourseProfileResource($this->whenLoaded('user')),
        ];
    }
}
