<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="CourseProfileOverviewResource",
 *  description="Course overview",
 *  @OA\Xml(
 *   name="CourseProfileOverviewResource"
 *  )
 * )
*/
class CourseProfileOverviewResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="fullname",
     *   type="string",
     *   description="full name",
     *   example="Gift Owens"
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
            'fullname' => $this->fullname
        ];
    }
}
