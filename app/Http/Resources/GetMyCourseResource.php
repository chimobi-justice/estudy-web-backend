<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMyCourseResource extends JsonResource
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
            'video' => collect($this->video)->count(),
            'created_at' => DateTimeResource::make($this->created_at)
        ];
    }
}
