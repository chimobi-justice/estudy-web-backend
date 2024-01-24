<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="CourseProfileResource",
 *  description="Course Profile Resource",
 *  @OA\Xml(
 *   name="CourseProfileResource"
 *  )
 * )
*/
class CourseProfileResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="fullname",
     *   type="string",
     *   description="Full name",
     *   example="Gift Owens"
     * )
     * @OA\Property(
     *   property="avatar",
     *   type="string",
     *   description="Course name",
     *   example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg"
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
            'fullname' => $this->fullname,
            'avatar' => $this->avatar
        ];
    }
}
