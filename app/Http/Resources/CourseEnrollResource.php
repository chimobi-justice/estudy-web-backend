<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *  title="CourseEnrollResource",
 *  description="Course students enrolled in ",
 *  @OA\Xml(
 *   name="CourseEnrollResource"
 *  )
 * )
*/
class CourseEnrollResource extends JsonResource
{
     /**
     * @OA\Property(
     *   property="course_id",
     *   type="string",
     *   description="course identifier",
     *   example="230e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *   property="user_id",
     *   type="string",
     *   description="user identifier",
     *   example="660e8400-e29b-41d4-a716-156655440000"
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
            'course_id' => $this->course_id,
            'user_id' => $this->user_id,
        ];
    }
}
