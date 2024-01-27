<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="MentorStudentDetailsResource",
 *  description="get students enrolled on mentor course details",
 *  @OA\Xml(
 *   name="MentorStudentDetailsResource"
 *  )
 * )
*/
class MentorStudentDetailsResource extends JsonResource
{
    /**
     * @OA\Property(
     *  property="id",
     *  type="string",
     *  format="uuid",
     *  description="id",
     *  example="550e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *  property="name",
     *  type="string",
     *  description="student enroll name",
     *  example="Owens Joe"
     * )
     * @OA\Property(
     *  property="avatar",
     *  type="string",
     *  description="student enroll avatar",
     *  example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg"
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
            'name' => $this->fullname,
            'avatar' => $this->avatar
        ];
    }
}
