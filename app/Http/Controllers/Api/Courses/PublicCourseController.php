<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicCourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PublicCourseController extends Controller
{
    /**
     * @OA\Get(
     *      path="/courses/all",
     *      operationId="getCoursesList",
     *      tags={"courses"},
     *      summary="Get list of Courses",
     *      description="Returns list of Courses",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data", 
     *                  type="array",
     *                   @OA\Items(
     *                   type="object",
     *                      ref="#/components/schemas/PublicCourseResource"
     *                   )
     *               )
     *           )
     *       )
     *  )
     */
    public function index(): JsonResource {
        $course = Course::latest()->get();

        return PublicCourseResource::collection($course); 
    }
}
