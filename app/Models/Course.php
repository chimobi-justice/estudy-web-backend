<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Course\CourseTraits;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *  title="Course",
 *  description="Course model",
 *  @OA\Xml(
 *    name="course",
 *  )
 * )
*/
class Course extends Model
{
    use HasFactory, HasUuid, CourseTraits, Sluggable;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     *  @OA\Property(
     *    title="Name",
     *    description="Name of the created Course",
     *    format="string",
     *    example="example name"
     *  )
    */
    private $name;

    /**
     *  @OA\Property(
     *    title="Price",
     *    description="Price of the created Course",
     *    format="string",
     *    example="10.00"
     *  )
    */
    private $price;

    /**
     * @OA\Property(
     *   property="videos",
     *   description="Array of videos",
     *   type="array",
     *   @OA\Items(
     *     type="string",
     *     format="uri",
     *     example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.mp4"
     *   )
     * )
     */
    private $video;

    /**
     *  @OA\Property(
     *    title="Category",
     *    description="category of the created Course",
     *    format="string",
     *    example="Web Development",
     *    enum={"Marketing", "Mobile Development", "Web Development"}
     *  )
    */
    private $category;

    /**
     *  @OA\Property(
     *    title="Description",
     *    description="Description of the created Course",
     *    format="string",
     *    example="short description"
     *  )
    */
    private $description;

    /**
     * @OA\Property(
     *   property="title",
     *   description="Array of titles",
     *   type="array",
     *   @OA\Items(
     *     type="string",
     *     example="Title 1"
     *   )
     * )
    */
    private $title;

    protected $fillable = [
        'name',
        'price',
        'video',
        'category',
        'thumbnail',
        'description',
        'title',
        'slug',
        'sub_title',
        'course_preview',
    ];

    protected $casts = [
        'video' => 'array',
        'title' => 'array',
        'sub_title' => 'array',
    ];

    protected $with = ['user', 'courseEnroll'];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
