<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
// use App\Http\Resources\DateTimeResource;
use App\Http\Resources\CourseProfileResourse;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentEnrollResource extends JsonResource
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
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'price' => $this->price,
            // 'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
