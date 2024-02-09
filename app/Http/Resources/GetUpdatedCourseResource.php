<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUpdatedCourseResource extends JsonResource
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
            'category' => $this->category,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'course_preview' => $this->course_preview,
            'video' => $this->video,
            'title' => $this->title,    
            'sub_title' => $this->sub_title,
        ];
    }
}
