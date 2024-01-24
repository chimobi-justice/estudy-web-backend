<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="PublicCourseResource",
 *  description="Public Course Resource",
 *  @OA\Xml(
 *   name="publicCourseResource"
 *  )
 * )
*/
class PublicCourseResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="id",
     *   type="string",
     *   format="uuid",
     *   description="Course ID",
     *   example="550e8400-e29b-41d4-a716-446655440000"
     * )
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   description="Course name",
     *   example="Intro Course"
     * )
     * @OA\Property(
     *   property="price",
     *   type="string",
     *   format="currency",
     *   description="Course price",
     *   example="20.00"
     * )
     * @OA\Property(
     *   property="thumbnail",
     *   type="string",
     *   description="URL of the course thumbnail",
     *   example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png"
     * 
     * )
     * @OA\Property(
     *   property="category",
     *   type="string",
     *   description="Course category",
     *   example="Web Development"
     * )
     * @OA\Property(
     *   property="description",
     *   type="string",
     *   description="Course description",
     *   example="example of course description"
     * )
     * @OA\Property(
     *   property="video",
     *   type="integer",
     *   description="Number of videos in the course",
     *   example="4"
     * )
     * @OA\Property(
     *   property="profile",
     *   ref="#/components/schemas/CourseProfileResource"
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
